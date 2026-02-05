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

use Twig\Compiler;
use Twig\Node\Node;

/**
 * Component Node
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class ComponentNode extends Node
{
    /**
     * Constructor
     *
     * @param string $componentName
     * @param Node|null $props
     * @param Node|null $body
     * @param array $slots
     * @param int $lineno
     * @param string|null $tag
     * @since 1.0.0
     */
    public function __construct(string $componentName, ?Node $props, ?Node $body, array $slots, int $lineno, ?string $tag = null)
    {
        $nodes = [];
        
        if ($props !== null) {
            $nodes['props'] = $props;
        }
        
        if ($body !== null) {
            $nodes['body'] = $body;
        }
        
        foreach ($slots as $name => $slot) {
            $nodes['slot_' . $name] = $slot;
        }
        
        parent::__construct($nodes, ['component' => $componentName], $lineno, $tag);
    }

    /**
     * @inheritdoc
     */
    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);
        
        // Start output buffering for body content
        if ($this->hasNode('body')) {
            $compiler
                ->write('ob_start();' . PHP_EOL)
                ->subcompile($this->getNode('body'))
                ->write('$__componentContent = ob_get_clean();' . PHP_EOL);
        } else {
            $compiler->write('$__componentContent = null;' . PHP_EOL);
        }
        
        // Compile slots
        $compiler->write('$__componentSlots = [];' . PHP_EOL);
        
        foreach ($this->nodes as $name => $node) {
            if (str_starts_with($name, 'slot_')) {
                $slotName = substr($name, 5);
                $compiler
                    ->write('ob_start();' . PHP_EOL)
                    ->subcompile($node)
                    ->write('$__componentSlots[\'' . $slotName . '\'] = ob_get_clean();' . PHP_EOL);
            }
        }
        
        // Render component
        $compiler->write('echo $this->env->getExtension(\'' . ComponentExtension::class . '\')->renderComponent(');
        
        // Component name
        $compiler->repr($this->getAttribute('component'));
        
        // Props
        $compiler->raw(', ');
        if ($this->hasNode('props')) {
            $compiler->subcompile($this->getNode('props'));
        } else {
            $compiler->raw('[]');
        }
        
        // Content
        $compiler->raw(', $__componentContent');
        
        // Slots
        $compiler->raw(', $__componentSlots');
        
        $compiler->raw(');' . PHP_EOL);
    }
}
