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
use craft\events\TemplateEvent;
use craft\web\UrlManager;
use craft\web\View;
use craft\web\twig\variables\CraftVariable;
use lindemannrock\componentmanager\models\Settings;
use lindemannrock\componentmanager\services\ComponentService;
use lindemannrock\componentmanager\services\DiscoveryService;
use lindemannrock\componentmanager\services\CacheService;
use lindemannrock\componentmanager\services\DocumentationService;
use lindemannrock\componentmanager\twig\ComponentExtension;
use lindemannrock\componentmanager\twig\ComponentLexer;
use lindemannrock\componentmanager\variables\ComponentVariable;
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
    /**
     * @var ComponentManager|null
     */
    public static ?ComponentManager $plugin = null;

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSettings = true;

    /**
     * @var bool
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
        
        // Override plugin name from config if available
        $configFileSettings = Craft::$app->getConfig()->getConfigFromFile('component-manager');
        if (isset($configFileSettings['pluginName'])) {
            $this->name = $configFileSettings['pluginName'];
        } else {
            // Get from database settings if set
            $settings = $this->getSettings();
            if ($settings && !empty($settings->pluginName)) {
                $this->name = $settings->pluginName;
            }
        }

        // Register services
        $this->setComponents([
            'components' => ComponentService::class,
            'discovery' => DiscoveryService::class,
            'cache' => CacheService::class,
            'documentation' => DocumentationService::class,
        ]);

        // Register Twig extension and lexer when Twig is created
        Event::on(
            View::class,
            View::EVENT_AFTER_CREATE_TWIG,
            function (CreateTwigEvent $event) {
                // Work on both frontend and CP
                if (Craft::$app->getRequest()->getIsSiteRequest() || Craft::$app->getRequest()->getIsCpRequest()) {
                    // Add our custom Twig extensions
                    $event->twig->addExtension(new ComponentExtension($this));
                    // Skip HighlightExtension for now
                    
                    // Set our custom lexer for HTML tag preprocessing
                    $event->twig->setLexer(new ComponentLexer($event->twig));
                }
            }
        );

        // Register variable
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
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

        // Register CP routes
        $this->_registerCpRoutes();

        // Clear cache on template changes in dev mode
        if (Craft::$app->getConfig()->getGeneral()->devMode) {
            Event::on(
                View::class,
                View::EVENT_AFTER_RENDER_TEMPLATE,
                function (TemplateEvent $event) {
                    if (str_contains($event->template, $this->getSettings()->defaultPath)) {
                        $this->cache->clearCache();
                    }
                }
            );
        }

        Craft::info(
            Craft::t(
                'component-manager',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
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

            $item['subnav'] = [
                'components' => [
                    'label' => Craft::t('component-manager', 'Components'),
                    'url' => 'component-manager',
                ],
            ];

            // Add documentation link if enabled
            $settings = $this->getSettings();
            if ($settings && $settings->enableDocumentation) {
                $item['subnav']['documentation'] = [
                    'label' => Craft::t('component-manager', 'Documentation'),
                    'url' => 'component-manager/documentation',
                ];
            }

            if (Craft::$app->getUser()->checkPermission('accessPlugin-component-manager')) {
                $item['subnav']['settings'] = [
                    'label' => Craft::t('component-manager', 'Settings'),
                    'url' => 'component-manager/settings',
                ];
            }
        }

        return $item;
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
        
        // Debug: Make sure settings object exists
        if (!$settings) {
            $settings = new Settings();
        }
        
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