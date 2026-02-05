<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\CreateTwigEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterUserPermissionsEvent;
use craft\services\UserPermissions;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use craft\web\View;
use lindemannrock\base\helpers\CpNavHelper;
use lindemannrock\base\helpers\PluginHelper;
use lindemannrock\componentmanager\models\Settings;
use lindemannrock\componentmanager\services\CacheService;
use lindemannrock\componentmanager\services\ComponentService;
use lindemannrock\componentmanager\services\DiscoveryService;
use lindemannrock\componentmanager\services\DocumentationService;
use lindemannrock\componentmanager\twig\ComponentExtension;
use lindemannrock\componentmanager\twig\ComponentLexer;
use lindemannrock\componentmanager\variables\ComponentVariable;
use lindemannrock\logginglibrary\LoggingLibrary;
use lindemannrock\logginglibrary\traits\LoggingTrait;
use yii\base\Event;

/**
 * Component Manager Plugin
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 *
 * @property  ComponentService $components
 * @property  DiscoveryService $discovery
 * @property  CacheService $cache
 * @property  DocumentationService $documentation
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class ComponentManager extends Plugin
{
    use LoggingTrait;

    /**
     * @var ComponentManager|null Singleton plugin instance
     * @since 1.0.0
     */
    public static ?ComponentManager $plugin = null;

    /**
     * @var string Plugin schema version for migrations
     * @since 1.0.0
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool Whether the plugin exposes a control panel settings page
     * @since 1.0.0
     */
    public bool $hasCpSettings = true;

    /**
     * @var bool Whether the plugin registers a control panel section
     * @since 1.0.0
     */
    public bool $hasCpSection = true;

    /**
     * @inheritdoc
     */
    public function getControllerMap(): array
    {
        return [
            'components' => 'lindemannrock\componentmanager\console\controllers\ComponentsController',
        ];
    }

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // Register services first (needed by ComponentExtension)
        $this->setComponents([
            'components' => ComponentService::class,
            'discovery' => DiscoveryService::class,
            'cache' => CacheService::class,
            'documentation' => DocumentationService::class,
        ]);

        // Register Twig extension using Craft's registerTwigExtension
        // This queues the extension to be added when Twig is created
        Craft::$app->view->registerTwigExtension(new ComponentExtension($this));

        // Also need to set the custom lexer via event (can't be queued)
        Event::on(
            View::class,
            View::EVENT_AFTER_CREATE_TWIG,
            function(CreateTwigEvent $event) {
                // Work on both frontend and CP
                if (Craft::$app->getRequest()->getIsSiteRequest() || Craft::$app->getRequest()->getIsCpRequest()) {
                    // Set our custom lexer for HTML tag preprocessing
                    $event->twig->setLexer(new ComponentLexer($event->twig));
                }
            }
        );

        // Bootstrap base module (logging + Twig extension)
        // NOTE: This may trigger Twig creation, so Twig event handlers must be registered above
        PluginHelper::bootstrap(
            $this,
            'componentHelper',
            ['componentManager:viewSystemLogs'],
            ['componentManager:downloadSystemLogs']
        );
        PluginHelper::applyPluginNameFromConfig($this);

        // Register Twig extension for plugin name helpers
        Craft::$app->view->registerTwigExtension(new \lindemannrock\componentmanager\twigextensions\PluginNameExtension());

        // Register variable
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('componentManager', ComponentVariable::class);
            }
        );

        // Register template roots for CP
        Event::on(
            View::class,
            View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['component-manager'] = __DIR__ . '/templates';
            }
        );

        // Register permissions
        Event::on(
            UserPermissions::class,
            UserPermissions::EVENT_REGISTER_PERMISSIONS,
            function(RegisterUserPermissionsEvent $event) {
                $event->permissions[] = [
                    'heading' => Craft::t('component-manager', 'Component Manager'),
                    'permissions' => [
                        'componentManager:viewLogs' => [
                            'label' => Craft::t('component-manager', 'View logs'),
                            'nested' => [
                                'componentManager:viewSystemLogs' => [
                                    'label' => Craft::t('component-manager', 'View system logs'),
                                    'nested' => [
                                        'componentManager:downloadSystemLogs' => [
                                            'label' => Craft::t('component-manager', 'Download system logs'),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
            }
        );

        // Register CP routes
        $this->_registerCpRoutes();

        // DO NOT log in init() - it's called on every request
    }

    /**
     * @inheritdoc
     */
    public function getCpNavItem(): ?array
    {
        $item = parent::getCpNavItem();

        if ($item) {
            // Use Craft's built-in puzzle-piece icon for components
            $item['icon'] = '@app/icons/puzzle-piece.svg';

            $settings = $this->getSettings();
            $user = Craft::$app->getUser();
            $sections = $this->getCpSections($settings);
            $item['subnav'] = CpNavHelper::buildSubnav($user, $settings, $sections);

            // Add logs section using logging library
            if (PluginHelper::isPluginEnabled('logging-library')) {
                $item = LoggingLibrary::addLogsNav($item, $this->handle, [
                    'componentManager:viewSystemLogs',
                ]);
            }

            // Hide from nav if no accessible subnav items
            if (empty($item['subnav'])) {
                return null;
            }
        }

        return $item;
    }

    /**
     * Get CP sections for nav + default route resolution
     *
     * @param Settings $settings
     * @param bool $includeComponents
     * @param bool $includeLogs
     * @return array
     * @since 5.5.0
     */
    public function getCpSections(Settings $settings, bool $includeComponents = true, bool $includeLogs = false): array
    {
        $sections = [];

        if ($includeComponents) {
            $sections[] = [
                'key' => 'components',
                'label' => Craft::t('component-manager', 'Components'),
                'url' => 'component-manager',
                'permissionsAll' => ['accessPlugin-component-manager'],
            ];
        }

        if ($settings->enableDocumentation) {
            $sections[] = [
                'key' => 'documentation',
                'label' => Craft::t('component-manager', 'Documentation'),
                'url' => 'component-manager/documentation',
                'permissionsAll' => ['accessPlugin-component-manager'],
            ];
        }

        if ($includeLogs) {
            $sections[] = [
                'key' => 'logs',
                'label' => Craft::t('component-manager', 'Logs'),
                'url' => 'component-manager/logs',
                'permissionsAll' => ['componentManager:viewSystemLogs'],
                'when' => fn() => PluginHelper::isPluginEnabled('logging-library'),
            ];
        }

        $sections[] = [
            'key' => 'settings',
            'label' => Craft::t('component-manager', 'Settings'),
            'url' => 'component-manager/settings',
            'permissionsAll' => ['accessPlugin-component-manager'],
        ];

        return $sections;
    }
    
    /**
     * @inheritdoc
     */
    public function getSettingsResponse(): mixed
    {
        return Craft::$app->controller->redirect('component-manager/settings');
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        // Load settings from database
        $settings = Settings::loadFromDatabase();

        // Then apply config file overrides
        $configFileSettings = Craft::$app->getConfig()->getConfigFromFile('component-manager');
        if ($configFileSettings) {
            // Apply all config file settings
            foreach ($configFileSettings as $key => $value) {
                if (property_exists($settings, $key)) {
                    $settings->$key = $value;
                }
            }
        }

        return $settings;
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): ?string
    {
        $settings = $this->getSettings();

        return Craft::$app->view->renderTemplate(
            'component-manager/settings',
            [
                'settings' => $settings,
                'plugin' => $this,
            ]
        );
    }
    
    /**
     * @inheritdoc
     */
    public function afterSaveSettings(): void
    {
        parent::afterSaveSettings();

        // Save settings to database
        $settings = $this->getSettings();
        $settings->saveToDatabase();

        // Clear component cache when settings change
        $this->cache->clearCache();
    }


    /**
     * Get component paths
     *
     * @return array
     * @since 1.0.0
     */
    public function getComponentPaths(): array
    {
        $settings = $this->getSettings();
        $paths = [];

        foreach ($settings->componentPaths as $path) {
            $fullPath = Craft::$app->getPath()->getSiteTemplatesPath() . DIRECTORY_SEPARATOR . $path;
            if (is_dir($fullPath)) {
                $paths[] = $fullPath;
            }
        }

        return $paths;
    }

    /**
     * Register CP routes
     */
    private function _registerCpRoutes(): void
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules = array_merge($event->rules, [
                    // Component routes
                    'component-manager' => 'component-manager/components/index',
                    'component-manager/components' => 'component-manager/components/index',
                    'component-manager/component/<componentName:.*>' => 'component-manager/components/detail',
                    'component-manager/documentation' => 'component-manager/components/documentation',
                    'component-manager/documentation/export' => 'component-manager/components/export-documentation',

                    // Preview routes
                    'component-manager/preview/render' => 'component-manager/preview/render',
                    'component-manager/preview/iframe' => 'component-manager/preview/iframe',

                    // Settings routes
                    'component-manager/settings' => 'component-manager/settings/index',
                    'component-manager/settings/general' => 'component-manager/settings/general',
                    'component-manager/settings/paths' => 'component-manager/settings/paths',
                    'component-manager/settings/features' => 'component-manager/settings/features',
                    'component-manager/settings/discovery' => 'component-manager/settings/discovery',
                    'component-manager/settings/library' => 'component-manager/settings/library',
                    'component-manager/settings/interface' => 'component-manager/settings/interface',
                    'component-manager/settings/maintenance' => 'component-manager/settings/maintenance',
                    'component-manager/settings/save' => 'component-manager/settings/save',
                ]);
            }
        );
    }
}
