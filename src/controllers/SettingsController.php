<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\controllers;

use lindemannrock\componentmanager\ComponentManager;

use Craft;
use craft\web\Controller;
use yii\web\Response;

/**
 * Settings Controller
 */
class SettingsController extends Controller
{
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
        
        $request = Craft::$app->getRequest();
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        // Only update non-overridden settings
        if (!$settings->isOverridden('pluginName')) {
            $settings->pluginName = $request->getBodyParam('pluginName', $settings->pluginName);
        }
        
        if (!$settings->isOverridden('componentPaths')) {
            $settings->componentPaths = $request->getBodyParam('componentPaths', $settings->componentPaths);
        }
        
        if (!$settings->isOverridden('defaultPath')) {
            $settings->defaultPath = $request->getBodyParam('defaultPath', $settings->defaultPath);
        }
        
        if (!$settings->isOverridden('componentExtension')) {
            $settings->componentExtension = $request->getBodyParam('componentExtension', $settings->componentExtension);
        }
        
        if (!$settings->isOverridden('enablePropValidation')) {
            $settings->enablePropValidation = (bool)$request->getBodyParam('enablePropValidation', $settings->enablePropValidation);
        }
        
        if (!$settings->isOverridden('enableCache')) {
            $settings->enableCache = (bool)$request->getBodyParam('enableCache', $settings->enableCache);
        }
        
        if (!$settings->isOverridden('cacheDuration')) {
            $settings->cacheDuration = (int)$request->getBodyParam('cacheDuration', $settings->cacheDuration);
        }
        
        if (!$settings->isOverridden('enableDebugMode')) {
            $settings->enableDebugMode = (bool)$request->getBodyParam('enableDebugMode', $settings->enableDebugMode);
        }
        
        if (!$settings->isOverridden('enableUsageTracking')) {
            $settings->enableUsageTracking = (bool)$request->getBodyParam('enableUsageTracking', $settings->enableUsageTracking);
        }
        
        if (!$settings->isOverridden('defaultSlotName')) {
            $settings->defaultSlotName = $request->getBodyParam('defaultSlotName', $settings->defaultSlotName);
        }
        
        if (!$settings->isOverridden('ignorePatterns')) {
            $settings->ignorePatterns = $request->getBodyParam('ignorePatterns', $settings->ignorePatterns);
        }
        
        if (!$settings->isOverridden('ignoreFolders')) {
            $settings->ignoreFolders = $request->getBodyParam('ignoreFolders', $settings->ignoreFolders);
        }
        
        if (!$settings->isOverridden('metadataFields')) {
            $settings->metadataFields = $request->getBodyParam('metadataFields', $settings->metadataFields);
        }
        
        if (!$settings->isOverridden('allowNesting')) {
            $settings->allowNesting = (bool)$request->getBodyParam('allowNesting', $settings->allowNesting);
        }
        
        if (!$settings->isOverridden('maxNestingDepth')) {
            $settings->maxNestingDepth = (int)$request->getBodyParam('maxNestingDepth', $settings->maxNestingDepth);
        }
        
        if (!$settings->isOverridden('enableInheritance')) {
            $settings->enableInheritance = (bool)$request->getBodyParam('enableInheritance', $settings->enableInheritance);
        }
        
        if (!$settings->isOverridden('enableDocumentation')) {
            $settings->enableDocumentation = (bool)$request->getBodyParam('enableDocumentation', $settings->enableDocumentation);
        }
        
        if (!$settings->isOverridden('allowInlineComponents')) {
            $settings->allowInlineComponents = (bool)$request->getBodyParam('allowInlineComponents', $settings->allowInlineComponents);
        }
        
        if (!$settings->isOverridden('enableComponentLibrary')) {
            $settings->enableComponentLibrary = (bool)$request->getBodyParam('enableComponentLibrary', $settings->enableComponentLibrary);
        }
        
        if (!$settings->isOverridden('showComponentSource')) {
            $settings->showComponentSource = (bool)$request->getBodyParam('showComponentSource', $settings->showComponentSource);
        }
        
        if (!$settings->isOverridden('enableLivePreview')) {
            $settings->enableLivePreview = (bool)$request->getBodyParam('enableLivePreview', $settings->enableLivePreview);
        }
        
        // Validate
        if (!$settings->validate()) {
            $errors = $settings->getErrors();
            $errorMessage = Craft::t('component-manager', 'Couldn\'t save plugin settings.');
            
            // Add validation errors to the message
            if (!empty($errors)) {
                $errorDetails = [];
                foreach ($errors as $attribute => $attributeErrors) {
                    $errorDetails[] = $attribute . ': ' . implode(', ', $attributeErrors);
                }
                $errorMessage .= ' ' . implode(' ', $errorDetails);
            }
            
            Craft::$app->getSession()->setError($errorMessage);
            
            Craft::$app->getUrlManager()->setRouteParams([
                'settings' => $settings
            ]);
            
            return null;
        }
        
        // Save to database
        if (!$settings->saveToDb()) {
            Craft::$app->getSession()->setError(Craft::t('component-manager', 'Couldn\'t save plugin settings.'));
            return null;
        }
        
        // Clear component cache when settings change
        $plugin->cache->clearCache();
        
        Craft::$app->getSession()->setNotice(Craft::t('component-manager', 'Plugin settings saved.'));
        
        // Redirect to the posted URL (which will be the section they came from)
        return $this->redirectToPostedUrl();
    }
}