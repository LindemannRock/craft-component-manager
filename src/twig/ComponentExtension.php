<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\twig;

use lindemannrock\componentmanager\ComponentManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Component Twig Extension
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class ComponentExtension extends AbstractExtension
{
    /**
     * @var ComponentManager
     */
    private ComponentManager $plugin;

    /**
     * Constructor
     *
     * @param ComponentManager $plugin
     * @since 1.0.0
     */
    public function __construct(ComponentManager $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'ComponentManager';
    }

    /**
     * @inheritdoc
     */
    public function getTokenParsers(): array
    {
        return [
            new ComponentTokenParser(),
            new SlotTokenParser(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('component', [$this, 'renderComponent'], ['is_safe' => ['html']]),
            new TwigFunction('c', [$this, 'renderComponent'], ['is_safe' => ['html']]),
            new TwigFunction('hasComponent', [$this, 'hasComponent']),
            new TwigFunction('componentProps', [$this, 'getComponentProps']),
            new TwigFunction('componentSlots', [$this, 'getComponentSlots']),
        ];
    }

    /**
     * Render a component
     *
     * @param string $name
     * @param array $props
     * @param string|null $content
     * @param array $slots
     * @return string
     * @since 1.0.0
     */
    public function renderComponent(string $name, array $props = [], ?string $content = null, array $slots = []): string
    {
        return $this->plugin->components->render($name, $props, $content, $slots);
    }

    /**
     * Check if a component exists
     *
     * @param string $name
     * @return bool
     * @since 1.0.0
     */
    public function hasComponent(string $name): bool
    {
        return $this->plugin->discovery->getComponent($name) !== null;
    }

    /**
     * Get component props definition
     *
     * @param string $name
     * @return array
     * @since 1.0.0
     */
    public function getComponentProps(string $name): array
    {
        $component = $this->plugin->discovery->getComponent($name);
        return $component ? $component->props : [];
    }

    /**
     * Get component slots
     *
     * @param string $name
     * @return array
     * @since 1.0.0
     */
    public function getComponentSlots(string $name): array
    {
        $component = $this->plugin->discovery->getComponent($name);
        return $component ? $component->slots : [];
    }
}
