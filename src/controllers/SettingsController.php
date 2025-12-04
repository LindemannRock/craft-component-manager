<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\controllers;

use Craft;
use craft\web\Controller;

use lindemannrock\componentmanager\ComponentManager;
use lindemannrock\componentmanager\models\Settings;
use lindemannrock\logginglibrary\traits\LoggingTrait;
use yii\web\Response;

/**
 * Settings Controller
 *
 * @since 1.0.0
 */
class SettingsController extends Controller
{
    use LoggingTrait;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        $this->setLoggingHandle('component-manager');
    }

    /**
     * Settings index - redirect to general
     */
    public function actionIndex(): Response
    {
        return $this->redirect('component-manager/settings/general');
    }
    
    /**
     * General settings
     */
    public function actionGeneral(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        return $this->renderTemplate('component-manager/settings/general', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Paths settings
     */
    public function actionPaths(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        return $this->renderTemplate('component-manager/settings/paths', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Features settings
     */
    public function actionFeatures(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        return $this->renderTemplate('component-manager/settings/features', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Discovery settings
     */
    public function actionDiscovery(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        return $this->renderTemplate('component-manager/settings/discovery', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Component Library settings
     */
    public function actionLibrary(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        return $this->renderTemplate('component-manager/settings/library', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Interface settings
     */
    public function actionInterface(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();

        return $this->renderTemplate('component-manager/settings/interface', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }

    /**
     * Maintenance settings
     */
    public function actionMaintenance(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();

        return $this->renderTemplate('component-manager/settings/maintenance', [
            'plugin' => $plugin,
            'settings' => $settings,
            'pluginName' => $plugin->name,
        ]);
    }

    /**
     * Save settings
     */
    public function actionSave(): ?Response
    {
        $this->requirePostRequest();

        $plugin = ComponentManager::getInstance();

        // Load current settings from database
        $settings = Settings::loadFromDatabase();

        // Get only the posted settings (fields from the current page)
        $settingsData = Craft::$app->getRequest()->getBodyParam('settings', []);

        // Only update fields that were posted and are not overridden by config
        foreach ($settingsData as $key => $value) {
            if (!$settings->isOverriddenByConfig($key) && property_exists($settings, $key)) {
                // Check for setter method first (handles array conversions, etc.)
                $setterMethod = 'set' . ucfirst($key);
                if (method_exists($settings, $setterMethod)) {
                    $settings->$setterMethod($value);
                } else {
                    $settings->$key = $value;
                }
            }
        }

        // Validate
        if (!$settings->validate()) {
            $this->logError('Settings validation failed', ['errors' => $settings->getErrors()]);
            Craft::$app->getSession()->setError(Craft::t('component-manager', 'Could not save settings.'));

            // Get the section to re-render the correct template with errors
            $section = $this->request->getBodyParam('section', 'general');
            $template = "component-manager/settings/{$section}";

            return $this->renderTemplate($template, [
                'settings' => $settings,
            ]);
        }

        // Save settings to database
        if ($settings->saveToDatabase()) {
            $this->logInfo('Settings saved successfully');

            // Update the plugin's cached settings (CRITICAL - forces Craft to refresh)
            $plugin->setSettings($settings->getAttributes());

            // Clear component cache when settings change
            $plugin->cache->clearCache();

            Craft::$app->getSession()->setNotice(Craft::t('component-manager', 'Settings saved successfully'));
        } else {
            $this->logError('Failed to save settings to database');
            Craft::$app->getSession()->setError(Craft::t('component-manager', 'Could not save settings'));
            return null;
        }

        return $this->redirectToPostedUrl();
    }
}
