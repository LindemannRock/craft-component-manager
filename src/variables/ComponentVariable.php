<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * Advanced Twig component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager\variables;

use lindemannrock\twigcomponentmanager\TwigComponentManager;

/**
 * Component Variable
 *
 * @author    LindemannRock
 * @package   TwigComponentManager
 * @since     1.0.0
 */
class ComponentVariable
{
    /**
     * Get all discovered components
     *
     * @return array
     */
    public function all(): array
    {
        return TwigComponentManager::$plugin->discovery->discoverComponents();
    }

    /**
     * Get a component by name
     *
     * @param string $name
     * @return \lindemannrock\twigcomponentmanager\models\ComponentModel|null
     */
    public function get(string $name)
    {
        return TwigComponentManager::$plugin->discovery->getComponent($name);
    }

    /**
     * Check if a component exists
     *
     * @param string $name
     * @return bool
     */
    public function exists(string $name): bool
    {
        return TwigComponentManager::$plugin->discovery->getComponent($name) !== null;
    }

    /**
     * Get components by category
     *
     * @param string $category
     * @return array
     */
    public function byCategory(string $category): array
    {
        return TwigComponentManager::$plugin->discovery->getComponentsByCategory($category);
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public function categories(): array
    {
        return TwigComponentManager::$plugin->discovery->getCategories();
    }

    /**
     * Get component usage statistics
     *
     * @return array
     */
    public function usage(): array
    {
        return TwigComponentManager::$plugin->components->getUsageStats();
    }

    /**
     * Validate a component
     *
     * @param string $name
     * @return array
     */
    public function validate(string $name): array
    {
        return TwigComponentManager::$plugin->components->validateComponent($name);
    }

    /**
     * Get cache statistics
     *
     * @return array
     */
    public function cacheStats(): array
    {
        return TwigComponentManager::$plugin->cache->getStats();
    }

    /**
     * Clear the component cache
     *
     * @return bool
     */
    public function clearCache(): bool
    {
        return TwigComponentManager::$plugin->cache->clearCache();
    }

    /**
     * Warm the component cache
     *
     * @return int
     */
    public function warmCache(): int
    {
        return TwigComponentManager::$plugin->cache->warmCache();
    }
}