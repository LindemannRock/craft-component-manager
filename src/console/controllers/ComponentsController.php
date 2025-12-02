<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\console\controllers;

use craft\console\Controller;
use lindemannrock\componentmanager\ComponentManager;

/**
 * Components controller
 */
class ComponentsController extends Controller
{
    /**
     * Sync components from filesystem to database
     *
     * @return int
     */
    public function actionSync(): int
    {
        $this->stdout("Syncing components from filesystem to database...\n");
        
        $results = ComponentManager::$plugin->discovery->syncToDatabase();
        
        $this->stdout("Created: {$results['created']}\n");
        $this->stdout("Updated: {$results['updated']}\n");
        $this->stdout("Deleted: {$results['deleted']}\n");
        
        if (!empty($results['errors'])) {
            $this->stderr("Errors:\n");
            foreach ($results['errors'] as $error) {
                $this->stderr("  - $error\n");
            }
        }
        
        $this->stdout("Sync complete!\n");
        return 0;
    }

    /**
     * Clear component cache and sync
     *
     * @return int
     */
    public function actionRefresh(): int
    {
        $this->stdout("Clearing component cache...\n");
        ComponentManager::$plugin->discovery->clearCache();
        ComponentManager::$plugin->cache->clearCache();
        
        return $this->actionSync();
    }
}
