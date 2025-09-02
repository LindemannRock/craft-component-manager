<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * Advanced Twig component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager;

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
use lindemannrock\twigcomponentmanager\models\Settings;
use lindemannrock\twigcomponentmanager\services\ComponentService;
use lindemannrock\twigcomponentmanager\services\DiscoveryService;
use lindemannrock\twigcomponentmanager\services\CacheService;
use lindemannrock\twigcomponentmanager\services\DocumentationService;
use lindemannrock\twigcomponentmanager\twig\ComponentExtension;
use lindemannrock\twigcomponentmanager\twig\ComponentLexer;
use lindemannrock\twigcomponentmanager\variables\ComponentVariable;
use yii\base\Event;

/**
 * Twig Component Manager Plugin
 *
 * @author    LindemannRock
 * @package   TwigComponentManager
 * @since     1.0.0
 *
 * @property  ComponentService $components
 * @property  DiscoveryService $discovery
 * @property  CacheService $cache
 * @property  DocumentationService $documentation
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class TwigComponentManager extends Plugin
{
    /**
     * @var TwigComponentManager|null
     */
    public static ?TwigComponentManager $plugin = null;

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
            'components' => 'lindemannrock\twigcomponentmanager\console\controllers\ComponentsController',
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
        $configFileSettings = Craft::$app->getConfig()->getConfigFromFile('twig-component-manager');
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
                $variable->set('twigComponentManager', ComponentVariable::class);
            }
        );

        // Register template roots for CP
        Event::on(
            View::class,
            View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['twig-component-manager'] = __DIR__ . '/templates';
            }
        );

        // Register CP routes
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules = array_merge($event->rules, [
                    'twig-component-manager' => 'twig-component-manager/components/index',
                    'twig-component-manager/components' => 'twig-component-manager/components/index',
                    'twig-component-manager/component/<componentName:.*>' => 'twig-component-manager/components/detail',
                    'twig-component-manager/documentation' => 'twig-component-manager/components/documentation',
                    'twig-component-manager/documentation/export' => 'twig-component-manager/components/export-documentation',
                    'twig-component-manager/preview/render' => 'twig-component-manager/preview/render',
                    'twig-component-manager/preview/iframe' => 'twig-component-manager/preview/iframe',
                    'twig-component-manager/settings' => 'twig-component-manager/settings/index',
                    'twig-component-manager/settings/general' => 'twig-component-manager/settings/general',
                    'twig-component-manager/settings/paths' => 'twig-component-manager/settings/paths',
                    'twig-component-manager/settings/features' => 'twig-component-manager/settings/features',
                    'twig-component-manager/settings/discovery' => 'twig-component-manager/settings/discovery',
                    'twig-component-manager/settings/library' => 'twig-component-manager/settings/library',
                    'twig-component-manager/settings/maintenance' => 'twig-component-manager/settings/maintenance',
                    'twig-component-manager/settings/save' => 'twig-component-manager/settings/save',
                ]);
            }
        );

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
                'twig-component-manager',
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
                    'label' => Craft::t('twig-component-manager', 'Components'),
                    'url' => 'twig-component-manager',
                ],
            ];
            
            // Add documentation link if enabled
            $settings = $this->getSettings();
            if ($settings && $settings->enableDocumentation) {
                $item['subnav']['documentation'] = [
                    'label' => Craft::t('twig-component-manager', 'Documentation'),
                    'url' => 'twig-component-manager/documentation',
                ];
            }

            if (Craft::$app->getUser()->checkPermission('accessPlugin-twig-component-manager')) {
                $item['subnav']['settings'] = [
                    'label' => Craft::t('twig-component-manager', 'Settings'),
                    'url' => 'twig-component-manager/settings',
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
        return Craft::$app->controller->redirect('twig-component-manager/settings');
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        $settings = new Settings();
        
        // Try to load settings from database first
        $settings->loadFromDb();
        
        // Then apply config file overrides
        $configFileSettings = Craft::$app->getConfig()->getConfigFromFile('twig-component-manager');
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
            'twig-component-manager/settings',
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
        $settings->saveToDb();
        
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
}