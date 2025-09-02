<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * Advanced Twig component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager\twig;

use Twig\Lexer;
use Twig\Source;
use Twig\TokenStream;

/**
 * Component Lexer
 * 
 * Preprocesses HTML-like component syntax into Twig tags
 * Converts: <x:button label="Click"> to {% x:button with {label: "Click"} %}
 *
 * @author    LindemannRock
 * @package   TwigComponentManager
 * @since     1.0.0
 */
class ComponentLexer extends Lexer
{
    /**
     * @inheritdoc
     */
    public function tokenize(Source $source): TokenStream
    {
        // Preprocess the source to convert HTML tags to Twig tags
        $preprocessed = $this->preprocessComponentTags($source->getCode());
        
        // Create new source with preprocessed code
        $newSource = new Source(
            $preprocessed,
            $source->getName(),
            $source->getPath()
        );
        
        // Let parent lexer handle the preprocessed Twig syntax
        return parent::tokenize($newSource);
    }
    
    /**
     * Preprocess component tags from HTML to Twig syntax
     *
     * @param string $template
     * @return string
     */
    protected function preprocessComponentTags(string $template): string
    {
        // Process slots first
        $template = $this->preprocessSlots($template);
        
        // Process self-closing tags
        $template = $this->preprocessSelfClosingTags($template);
        
        // Process opening tags
        $template = $this->preprocessOpeningTags($template);
        
        // Process closing tags
        $template = $this->preprocessClosingTags($template);
        
        return $template;
    }
    
    /**
     * Process slot tags
     * <x:slot name="header"> becomes {% slot:header %}
     *
     * @param string $template
     * @return string
     */
    protected function preprocessSlots(string $template): string
    {
        // Match <x:slot name="slotname" ...>
        $pattern = '/<\s*x:slot\s+(?:name=)["\']([^"\']+)["\']\s*(?:[^>]*)>/';
        $template = preg_replace_callback($pattern, function($matches) {
            $slotName = $matches[1];
            return "{% slot:$slotName %}";
        }, $template);
        
        // Match closing slot tags
        $template = preg_replace('/<\/\s*x:slot\s*>/', '{% endslot %}', $template);
        
        return $template;
    }
    
    /**
     * Process self-closing component tags
     * <x:button label="Click" /> becomes {% x:button with {label: "Click"} %}{% endx %}
     *
     * @param string $template
     * @return string
     */
    protected function preprocessSelfClosingTags(string $template): string
    {
        // Match <x:component-name attr="value" ... />
        $pattern = '/<\s*x:([\w\-\/]+)\s*([^>]*?)\/>/';
        
        return preg_replace_callback($pattern, function($matches) {
            $componentName = $this->normalizeComponentName($matches[1]);
            $attributes = $this->parseAttributes($matches[2]);
            
            if (empty($attributes)) {
                return "{% x:$componentName %}{% endx %}";
            }
            
            return "{% x:$componentName with {$attributes} %}{% endx %}";
        }, $template);
    }
    
    /**
     * Process opening component tags
     * <x:button label="Click"> becomes {% x:button with {label: "Click"} %}
     *
     * @param string $template
     * @return string
     */
    protected function preprocessOpeningTags(string $template): string
    {
        // Match <x:component-name attr="value" ...>
        $pattern = '/<\s*x:([\w\-\/]+)\s*([^>]*?)>/';
        
        return preg_replace_callback($pattern, function($matches) {
            $componentName = $this->normalizeComponentName($matches[1]);
            $attributes = $this->parseAttributes($matches[2]);
            
            if (empty($attributes)) {
                return "{% x:$componentName %}";
            }
            
            return "{% x:$componentName with {$attributes} %}";
        }, $template);
    }
    
    /**
     * Process closing component tags
     * </x:button> becomes {% endx %}
     *
     * @param string $template
     * @return string
     */
    protected function preprocessClosingTags(string $template): string
    {
        // Match </x:component-name>
        $pattern = '/<\/\s*x:([\w\-\/]+)\s*>/';
        
        return preg_replace('/<\/\s*x:[\w\-\/]+\s*>/', '{% endx %}', $template);
    }
    
    /**
     * Parse HTML attributes into Twig hash syntax
     *
     * @param string $attributeString
     * @return string
     */
    protected function parseAttributes(string $attributeString): string
    {
        if (empty(trim($attributeString))) {
            return '';
        }
        
        $attributes = [];
        
        // Match attribute="value" or attribute='value' or :attribute="expression"
        $pattern = '/(?:^|\s+)([:@]?)([\w\-]+)(?:=(["\'])([^"\']*)\3)?/';
        
        preg_match_all($pattern, $attributeString, $matches, PREG_SET_ORDER);
        
        foreach ($matches as $match) {
            $prefix = $match[1];
            $name = $match[2];
            $value = isset($match[4]) ? $match[4] : 'true';
            
            // Handle dynamic attributes (prefixed with : or @)
            if ($prefix === ':' || $prefix === '@') {
                // Dynamic attribute - don't quote the value
                $attributes[] = "$name: $value";
            } else {
                // Static attribute - quote the value
                // Escape quotes in the value
                $value = str_replace('"', '\\"', $value);
                $attributes[] = "$name: \"$value\"";
            }
        }
        
        return implode(', ', $attributes);
    }
    
    /**
     * Normalize component name
     * Keep slashes as-is for folder organization
     *
     * @param string $name
     * @return string
     */
    protected function normalizeComponentName(string $name): string
    {
        // Keep the name exactly as provided to support folder paths
        // This allows <x:forms/input> to map to _components/forms/input.twig
        return $name;
    }
}