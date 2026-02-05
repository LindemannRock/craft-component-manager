<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\twigextensions;

use lindemannrock\componentmanager\ComponentManager;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

/**
 * Plugin Name Twig Extension
 *
 * @since 1.0.0
 */
class PluginNameExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @return string
     * @since 5.2.0
     */
    public function getName(): string
    {
        return 'Component Manager - Plugin Name Helper';
    }

    /**
     * @return array
     * @since 5.2.0
     */
    public function getGlobals(): array
    {
        return [
            'componentHelper' => new PluginNameHelper(),
        ];
    }
}

/**
 * Plugin Name Helper
 *
 * @since 5.2.0
 */
class PluginNameHelper
{
    /**
     * @return string
     * @since 5.2.0
     */
    public function getDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getDisplayName();
    }

    /**
     * @return string
     * @since 5.2.0
     */
    public function getPluralDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getPluralDisplayName();
    }

    /**
     * @return string
     * @since 5.2.0
     */
    public function getFullName(): string
    {
        return ComponentManager::$plugin->getSettings()->getFullName();
    }

    /**
     * @return string
     * @since 5.2.0
     */
    public function getLowerDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getLowerDisplayName();
    }

    /**
     * @return string
     * @since 5.2.0
     */
    public function getPluralLowerDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getPluralLowerDisplayName();
    }

    /**
     * @param string $name
     * @return string|null
     * @since 5.2.0
     */
    public function __get(string $name): ?string
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return null;
    }
}
