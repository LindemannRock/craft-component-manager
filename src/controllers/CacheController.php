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
 * Cache Controller
 */
class CacheController extends Controller
{
    /**
     * Clear component cache
     */
    public function actionClear(): Response
    {
        $this->requirePostRequest();
        
        $plugin = ComponentManager::getInstance();
        
        // Clear the component cache
        $plugin->cache->clearCache();
        
        // Clear discovery cache
        $plugin->discovery->clearCache();
        
        Craft::$app->getSession()->setNotice(Craft::t('component-manager', 'Component cache cleared successfully.'));
        
        return $this->redirectToPostedUrl();
    }
}