<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\variables;

use lindemannrock\componentmanager\ComponentManager;

/**
 * Component Variable
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class ComponentVariable
{
    /**
     * Get all discovered components
     *
     * @return array
     * @since 1.0.0
     */
    public function all(): array
    {
        return ComponentManager::$plugin->discovery->discoverComponents();
    }

    /**
     * Get a component by name
     *
     * @param string $name
     * @return \lindemannrock\componentmanager\models\ComponentModel|null
     * @since 1.0.0
     */
    public function get(string $name)
    {
        return ComponentManager::$plugin->discovery->getComponent($name);
    }

    /**
     * Check if a component exists
     *
     * @param string $name
     * @return bool
     * @since 1.0.0
     */
    public function exists(string $name): bool
    {
        return ComponentManager::$plugin->discovery->getComponent($name) !== null;
    }

    /**
     * Get components by category
     *
     * @param string $category
     * @return array
     * @since 1.0.0
     */
    public function byCategory(string $category): array
    {
        return ComponentManager::$plugin->discovery->getComponentsByCategory($category);
    }

    /**
     * Get all categories
     *
     * @return array
     * @since 1.0.0
     */
    public function categories(): array
    {
        return ComponentManager::$plugin->discovery->getCategories();
    }

    /**
     * Get component usage statistics
     *
     * @return array
     * @since 1.0.0
     */
    public function usage(): array
    {
        return ComponentManager::$plugin->components->getUsageStats();
    }

    /**
     * Validate a component
     *
     * @param string $name
     * @return array
     * @since 1.0.0
     */
    public function validate(string $name): array
    {
        return ComponentManager::$plugin->components->validateComponent($name);
    }

    /**
     * Get cache statistics
     *
     * @return array
     * @since 1.0.0
     */
    public function cacheStats(): array
    {
        return ComponentManager::$plugin->cache->getStats();
    }

    /**
     * Clear the component cache
     *
     * @return bool
     * @since 1.0.0
     */
    public function clearCache(): bool
    {
        return ComponentManager::$plugin->cache->clearCache();
    }

    /**
     * Warm the component cache
     *
     * @return int
     * @since 1.0.0
     */
    public function warmCache(): int
    {
        return ComponentManager::$plugin->cache->warmCache();
    }
}
