<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\services;

use Craft;
use craft\base\Component;
use lindemannrock\componentmanager\ComponentManager;

/**
 * Cache Service
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class CacheService extends Component
{
    const CACHE_KEY_PREFIX = 'twig-component-manager-';
    const COMPONENTS_CACHE_KEY = 'discovered-components';
    const COMPILED_CACHE_KEY = 'compiled-';

    /**
     * Get cached components
     *
     * @return array|null
     */
    public function getComponents(): ?array
    {
        $settings = ComponentManager::$plugin->getSettings();
        
        if (!$settings->enableCache) {
            return null;
        }
        
        $cacheKey = self::CACHE_KEY_PREFIX . self::COMPONENTS_CACHE_KEY;
        return Craft::$app->getCache()->get($cacheKey);
    }

    /**
     * Set cached components
     *
     * @param array $components
     * @return bool
     */
    public function setComponents(array $components): bool
    {
        $settings = ComponentManager::$plugin->getSettings();
        
        if (!$settings->enableCache) {
            return false;
        }
        
        $cacheKey = self::CACHE_KEY_PREFIX . self::COMPONENTS_CACHE_KEY;
        $duration = $settings->cacheDuration ?: null;
        
        return Craft::$app->getCache()->set($cacheKey, $components, $duration);
    }

    /**
     * Get compiled component
     *
     * @param string $name
     * @return string|null
     */
    public function getCompiled(string $name): ?string
    {
        $settings = ComponentManager::$plugin->getSettings();
        
        if (!$settings->enableCache) {
            return null;
        }
        
        $cacheKey = self::CACHE_KEY_PREFIX . self::COMPILED_CACHE_KEY . md5($name);
        return Craft::$app->getCache()->get($cacheKey);
    }

    /**
     * Set compiled component
     *
     * @param string $name
     * @param string $compiled
     * @return bool
     */
    public function setCompiled(string $name, string $compiled): bool
    {
        $settings = ComponentManager::$plugin->getSettings();
        
        if (!$settings->enableCache) {
            return false;
        }
        
        $cacheKey = self::CACHE_KEY_PREFIX . self::COMPILED_CACHE_KEY . md5($name);
        $duration = $settings->cacheDuration ?: null;
        
        return Craft::$app->getCache()->set($cacheKey, $compiled, $duration);
    }

    /**
     * Clear all cache
     *
     * @return bool
     */
    public function clearCache(): bool
    {
        // Clear discovered components
        $this->clearComponents();
        
        // Clear compiled components
        $this->clearCompiled();
        
        // Clear discovery service cache
        ComponentManager::$plugin->discovery->clearCache();
        
        Craft::info('Component cache cleared', __METHOD__);
        
        return true;
    }

    /**
     * Clear components cache
     *
     * @return bool
     */
    public function clearComponents(): bool
    {
        $cacheKey = self::CACHE_KEY_PREFIX . self::COMPONENTS_CACHE_KEY;
        return Craft::$app->getCache()->delete($cacheKey);
    }

    /**
     * Clear compiled cache
     *
     * @return bool
     */
    public function clearCompiled(): bool
    {
        // Since we can't easily delete all keys with a prefix,
        // we'll need to track compiled components
        $components = ComponentManager::$plugin->discovery->discoverComponents();
        
        foreach ($components as $component) {
            $cacheKey = self::CACHE_KEY_PREFIX . self::COMPILED_CACHE_KEY . md5($component->name);
            Craft::$app->getCache()->delete($cacheKey);
        }
        
        return true;
    }

    /**
     * Get cache statistics
     *
     * @return array
     */
    public function getStats(): array
    {
        $stats = [
            'enabled' => ComponentManager::$plugin->getSettings()->enableCache,
            'components' => 0,
            'compiled' => 0,
            'size' => 0,
        ];
        
        // Count cached components
        if ($this->getComponents() !== null) {
            $stats['components'] = count($this->getComponents());
        }
        
        // Count compiled components
        $components = ComponentManager::$plugin->discovery->discoverComponents();
        foreach ($components as $component) {
            if ($this->getCompiled($component->name) !== null) {
                $stats['compiled']++;
            }
        }
        
        return $stats;
    }

    /**
     * Warm the cache
     *
     * @return int Number of components cached
     */
    public function warmCache(): int
    {
        $count = 0;
        $components = ComponentManager::$plugin->discovery->discoverComponents(true);
        
        foreach ($components as $component) {
            // Pre-compile each component
            try {
                $content = file_get_contents($component->path);
                $this->setCompiled($component->name, $content);
                $count++;
            } catch (\Exception $e) {
                Craft::warning("Failed to warm cache for component '{$component->name}': " . $e->getMessage(), __METHOD__);
            }
        }
        
        Craft::info("Warmed cache for {$count} components", __METHOD__);
        
        return $count;
    }
}