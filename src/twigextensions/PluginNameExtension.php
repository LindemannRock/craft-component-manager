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
 */
class PluginNameExtension extends AbstractExtension implements GlobalsInterface
{
    public function getName(): string
    {
        return 'Component Manager - Plugin Name Helper';
    }

    public function getGlobals(): array
    {
        return [
            'componentHelper' => new PluginNameHelper(),
        ];
    }
}

class PluginNameHelper
{
    public function getDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getDisplayName();
    }

    public function getPluralDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getPluralDisplayName();
    }

    public function getFullName(): string
    {
        return ComponentManager::$plugin->getSettings()->getFullName();
    }

    public function getLowerDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getLowerDisplayName();
    }

    public function getPluralLowerDisplayName(): string
    {
        return ComponentManager::$plugin->getSettings()->getPluralLowerDisplayName();
    }

    public function __get(string $name): ?string
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return null;
    }
}
