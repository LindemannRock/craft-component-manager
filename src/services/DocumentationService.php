<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager\services;

use lindemannrock\twigcomponentmanager\TwigComponentManager;
use lindemannrock\twigcomponentmanager\models\ComponentModel;

use Craft;
use craft\base\Component;
use craft\helpers\FileHelper;
use craft\helpers\Json;
use craft\helpers\StringHelper;

/**
 * Documentation Service
 * 
 * Generates automatic documentation for Twig components
 */
class DocumentationService extends Component
{
    /**
     * Generate documentation for all components
     *
     * @return array
     */
    public function generateAllDocumentation(): array
    {
        $plugin = TwigComponentManager::getInstance();
        $components = $plugin->discovery->discoverComponents();
        $documentation = [];
        
        foreach ($components as $component) {
            $documentation[] = $this->generateComponentDocumentation($component);
        }
        
        return $documentation;
    }
    
    /**
     * Generate documentation for a single component
     *
     * @param ComponentModel $component Component model from discovery
     * @return array
     */
    public function generateComponentDocumentation(ComponentModel $component): array
    {
        $doc = [
            'name' => $component->name,
            'path' => $component->relativePath,
            'category' => $component->category ?? null,
            'description' => $component->metadata['description'] ?? null,
            'props' => [],
            'slots' => [],
            'examples' => [],
            'usage' => [],
            'metadata' => $component->metadata ?? [],
        ];
        
        // Parse component file for additional documentation
        $fullPath = $component->path;
        if (file_exists($fullPath)) {
            $content = file_get_contents($fullPath);
            
            // Extract props documentation
            $doc['props'] = $this->extractPropsDocumentation($content, $component->props ?? []);
            
            // Extract slots documentation
            $doc['slots'] = $this->extractSlotsDocumentation($content, $component->slots ?? []);
            
            // Extract examples (pass component name for code generation)
            $doc['examples'] = $this->extractExamples($content, $component->name);
            
            // Extract usage notes
            $doc['usage'] = $this->extractUsageNotes($content);
        }
        
        return $doc;
    }
    
    /**
     * Extract props documentation from component file
     *
     * @param string $content Component file content
     * @param array $props Props from discovery
     * @return array
     */
    protected function extractPropsDocumentation(string $content, array $props): array
    {
        $documented = [];
        
        // Look for JSDoc-style prop documentation
        // Example: {# @prop {string} variant - The button variant (primary|secondary|danger) #}
        $pattern = '/{#\s*@prop\s+\{([^}]+)\}\s+(\w+)\s*(?:-\s*(.+))?\s*#}/';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        
        foreach ($matches as $match) {
            $propName = $match[2];
            $documented[$propName] = [
                'name' => $propName,
                'type' => $match[1],
                'description' => $match[3] ?? null,
                'required' => false,
                'default' => null,
            ];
        }
        
        // Merge with discovered props
        foreach ($props as $propName => $propData) {
            if (!isset($documented[$propName])) {
                $documented[$propName] = [
                    'name' => $propName,
                    'type' => $this->inferPropType($propData),
                    'description' => null,
                    'required' => $propData['required'] ?? false,
                    'default' => $propData['default'] ?? null,
                ];
            } else {
                // Merge discovered data
                $documented[$propName]['required'] = $propData['required'] ?? false;
                $documented[$propName]['default'] = $propData['default'] ?? null;
            }
        }
        
        // Look for prop validation rules
        $this->extractPropValidation($content, $documented);
        
        return array_values($documented);
    }
    
    /**
     * Extract slots documentation from component file
     *
     * @param string $content Component file content
     * @param array $slots Slots from discovery
     * @return array
     */
    protected function extractSlotsDocumentation(string $content, array $slots): array
    {
        $documented = [];
        
        // Look for JSDoc-style slot documentation
        // Example: {# @slot header - The header content #}
        $pattern = '/{#\s*@slot\s+(\w+)\s*(?:-\s*(.+))?\s*#}/';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        
        foreach ($matches as $match) {
            $slotName = $match[1];
            $documented[$slotName] = [
                'name' => $slotName,
                'description' => $match[2] ?? null,
                'required' => false,
            ];
        }
        
        // Merge with discovered slots
        foreach ($slots as $slotName) {
            if (!isset($documented[$slotName])) {
                $documented[$slotName] = [
                    'name' => $slotName,
                    'description' => null,
                    'required' => false,
                ];
            }
        }
        
        return array_values($documented);
    }
    
    /**
     * Extract examples from component file
     *
     * @param string $content Component file content
     * @param string $componentName The name of the component for code generation
     * @return array
     */
    protected function extractExamples(string $content, string $componentName = 'component'): array
    {
        $examples = [];
        
        // First, try to find structured @examples JSON/array format
        // Look for @examples followed by JSON array, more flexible ending
        if (preg_match('/@examples\s*(\[[\s\S]*?\])/m', $content, $jsonMatch)) {
            $jsonStr = trim($jsonMatch[1]);
            \Craft::info("Found JSON examples: " . $jsonStr, 'twig-component-manager');
            // Try to parse as JSON
            $decoded = json_decode($jsonStr, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                \Craft::info("JSON parsed successfully: " . json_encode($decoded), 'twig-component-manager');
                foreach ($decoded as $index => $example) {
                    \Craft::info("Processing JSON example {$index}: " . json_encode($example), 'twig-component-manager');
                    $examples[] = [
                        'id' => $example['id'] ?? 'example-' . ($index + 1),
                        'title' => $example['title'] ?? 'Example ' . ($index + 1),
                        'props' => $example['props'] ?? [],
                        'slots' => $example['slots'] ?? [],
                        'content' => $example['content'] ?? '',
                        'code' => $this->generateExampleCode($example, $componentName),
                    ];
                    \Craft::info("Created example with content: '{$examples[count($examples)-1]['content']}' and slots: " . json_encode($examples[count($examples)-1]['slots']), 'twig-component-manager');
                }
                // If we found structured examples, return them
                if (!empty($examples)) {
                    return $examples;
                }
            }
        }
        
        // Fallback to the original regex-based extraction
        // Look for example blocks within comment blocks
        if (preg_match('/{#([\s\S]*?)#}/', $content, $commentMatch)) {
            $commentContent = $commentMatch[1];
            
            // Now extract individual @example blocks from within the comment
            $pattern = '/@example\s+"([^"]+)"\s*([\s\S]*?)(?=@example|@usage|@props|@slot|$)/';
            preg_match_all($pattern, $commentContent, $matches, PREG_SET_ORDER);
        } else {
            // Fallback to looking for individual example blocks
            $pattern = '/{#\s*@example\s+"([^"]+)"\s*([\s\S]*?)\s*#}/';
            preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        }
        
        foreach ($matches as $match) {
            $code = trim($match[2]);
            $props = [];
            
            // Try to extract props from the with block - handle multiline
            // Use [^%\s] to match any non-space, non-% characters for component names
            if (preg_match('/\{%\s*x:([^%\s]+)\s+with\s+\{([^}]+)\}/s', $code, $propMatch)) {
                $propsStr = $propMatch[2];
                // Parse key: value pairs, handling multiline and various value types
                // Updated pattern to handle newlines and more complex values including dots in strings
                if (preg_match_all('/(\w+)\s*:\s*([\'"][^\'\"]*[\'"]|true|false|null|\d+(?:\.\d+)?)/s', $propsStr, $propMatches, PREG_SET_ORDER)) {
                    foreach ($propMatches as $propMatch) {
                        $key = $propMatch[1];
                        $value = $propMatch[2];
                        // Remove quotes if string
                        if (preg_match('/^[\'"](.+)[\'"]$/', $value, $valueMatch)) {
                            $value = $valueMatch[1];
                        } elseif ($value === 'true') {
                            $value = true;
                        } elseif ($value === 'false') {
                            $value = false;
                        } elseif ($value === 'null') {
                            $value = null;
                        } elseif (is_numeric($value)) {
                            $value = strpos($value, '.') !== false ? (float)$value : (int)$value;
                        }
                        $props[$key] = $value;
                    }
                }
            }
            
            // Extract default content and slots from the example
            $content = '';
            $slots = [];
            
            // Extract content between component tags - improved regex
            if (preg_match('/\{%\s*x:[^}]+\}(.*?)\{%\s*endx\s*%\}/s', $code, $contentMatch)) {
                $fullContent = trim($contentMatch[1]);
                
                // Extract named slots first
                if (preg_match_all('/\{%\s*slot\s+(\w+)\s*%\}(.*?)\{%\s*endslot\s*%\}/s', $fullContent, $slotMatches, PREG_SET_ORDER)) {
                    foreach ($slotMatches as $slotMatch) {
                        $slots[$slotMatch[1]] = trim($slotMatch[2]);
                        // Remove slot blocks from content
                        $fullContent = str_replace($slotMatch[0], '', $fullContent);
                    }
                }
                
                // What's left is the default content (clean up whitespace)
                $content = trim(preg_replace('/\s+/', ' ', $fullContent));
                
                // Debug logging
                \Craft::info("Extracted content: '{$content}', slots: " . json_encode($slots), 'twig-component-manager');
            }
            
            $examples[] = [
                'id' => 'example-' . (count($examples) + 1),
                'title' => $match[1],
                'code' => $code,
                'props' => $props,
                'content' => $content,
                'slots' => $slots,
            ];
        }
        
        // Also look for inline examples in comments
        $pattern = '/{#\s*Example:\s*([\s\S]*?)\s*#}/';
        preg_match_all($pattern, $content, $matches);
        
        foreach ($matches[1] as $i => $example) {
            $examples[] = [
                'title' => 'Example ' . ($i + 1),
                'code' => trim($example),
            ];
        }
        
        return $examples;
    }
    
    /**
     * Generate example code from structured example data
     *
     * @param array $example
     * @param string $componentName The name of the component
     * @return string
     */
    protected function generateExampleCode(array $example, string $componentName = 'component'): string
    {
        
        $code = '{% x:' . $componentName;
        
        if (!empty($example['props'])) {
            $code .= ' with {';
            $propLines = [];
            foreach ($example['props'] as $key => $value) {
                if (is_bool($value)) {
                    $propLines[] = $key . ': ' . ($value ? 'true' : 'false');
                } elseif (is_numeric($value)) {
                    $propLines[] = $key . ': ' . $value;
                } elseif (is_null($value)) {
                    $propLines[] = $key . ': null';
                } else {
                    $propLines[] = $key . ': \'' . addslashes($value) . '\'';
                }
            }
            $code .= "\n    " . implode(",\n    ", $propLines) . "\n} ";
        }
        
        $code .= '%}';
        
        if (!empty($example['slots'])) {
            foreach ($example['slots'] as $slotName => $slotContent) {
                $code .= "\n    {% slot $slotName %}\n        $slotContent\n    {% endslot %}";
            }
        } elseif (!empty($example['content'])) {
            $code .= "\n    " . $example['content'];
        }
        
        $code .= "\n{% endx %}";
        
        return $code;
    }
    
    /**
     * Extract usage notes from component file
     *
     * @param string $content Component file content
     * @return array
     */
    protected function extractUsageNotes(string $content): array
    {
        $notes = [];
        
        // Look for usage notes
        // Example: {# @usage This component should be used for... #}
        $pattern = '/{#\s*@usage\s+([\s\S]*?)\s*#}/';
        preg_match_all($pattern, $content, $matches);
        
        foreach ($matches[1] as $note) {
            $notes[] = trim($note);
        }
        
        return $notes;
    }
    
    /**
     * Extract prop validation rules from component
     *
     * @param string $content Component file content
     * @param array &$props Props array to update
     */
    protected function extractPropValidation(string $content, array &$props): void
    {
        // Look for prop validation blocks
        $pattern = '/\{%\s*props\s+([\s\S]*?)\s*%\}/';
        if (preg_match($pattern, $content, $match)) {
            $validationBlock = $match[1];
            
            // Parse individual prop validations
            $propPattern = '/(\w+)\s*:\s*\{([^}]+)\}/';
            preg_match_all($propPattern, $validationBlock, $propMatches, PREG_SET_ORDER);
            
            foreach ($propMatches as $propMatch) {
                $propName = $propMatch[1];
                $rules = $propMatch[2];
                
                if (isset($props[$propName])) {
                    // Extract validation rules
                    if (preg_match('/type:\s*[\'"]([^\'"]+)/', $rules, $typeMatch)) {
                        $props[$propName]['type'] = $typeMatch[1];
                    }
                    if (preg_match('/required:\s*(true|false)/', $rules, $reqMatch)) {
                        $props[$propName]['required'] = $reqMatch[1] === 'true';
                    }
                    if (preg_match('/default:\s*[\'"]([^\'"]+)/', $rules, $defMatch)) {
                        $props[$propName]['default'] = $defMatch[1];
                    }
                    if (preg_match('/enum:\s*\[([^\]]+)\]/', $rules, $enumMatch)) {
                        $props[$propName]['enum'] = array_map('trim', explode(',', $enumMatch[1]));
                    }
                }
            }
        }
    }
    
    /**
     * Infer prop type from prop data
     *
     * @param mixed $propData
     * @return string
     */
    protected function inferPropType($propData): string
    {
        if (is_array($propData)) {
            if (isset($propData['type'])) {
                return $propData['type'];
            }
            if (isset($propData['default'])) {
                return gettype($propData['default']);
            }
        }
        
        return 'mixed';
    }
    
    /**
     * Generate markdown documentation for all components
     *
     * @return string
     */
    public function generateMarkdownDocumentation(): string
    {
        $docs = $this->generateAllDocumentation();
        $markdown = "# Component Documentation\n\n";
        $markdown .= "Generated on " . date('Y-m-d H:i:s') . "\n\n";
        
        // Group by category
        $grouped = [];
        foreach ($docs as $doc) {
            $category = $doc['category'] ?? 'Uncategorized';
            if (!isset($grouped[$category])) {
                $grouped[$category] = [];
            }
            $grouped[$category][] = $doc;
        }
        
        // Sort categories
        ksort($grouped);
        
        // Generate TOC
        $markdown .= "## Table of Contents\n\n";
        foreach ($grouped as $category => $components) {
            $markdown .= "- **{$category}**\n";
            foreach ($components as $component) {
                $anchor = StringHelper::toKebabCase($component['name']);
                $markdown .= "  - [{$component['name']}](#{$anchor})\n";
            }
        }
        $markdown .= "\n---\n\n";
        
        // Generate component documentation
        foreach ($grouped as $category => $components) {
            $markdown .= "## {$category}\n\n";
            
            foreach ($components as $component) {
                $anchor = StringHelper::toKebabCase($component['name']);
                $markdown .= "### <a name=\"{$anchor}\"></a>{$component['name']}\n\n";
                
                if ($component['description']) {
                    $markdown .= "{$component['description']}\n\n";
                }
                
                $markdown .= "**Path:** `{$component['path']}`\n\n";
                
                // Props
                if (!empty($component['props'])) {
                    $markdown .= "#### Props\n\n";
                    $markdown .= "| Name | Type | Required | Default | Description |\n";
                    $markdown .= "|------|------|----------|---------|-------------|\n";
                    
                    foreach ($component['props'] as $prop) {
                        $required = $prop['required'] ? 'Yes' : 'No';
                        $default = $prop['default'] !== null ? "`{$prop['default']}`" : '-';
                        $description = $prop['description'] ?? '-';
                        $markdown .= "| {$prop['name']} | {$prop['type']} | {$required} | {$default} | {$description} |\n";
                    }
                    $markdown .= "\n";
                }
                
                // Slots
                if (!empty($component['slots'])) {
                    $markdown .= "#### Slots\n\n";
                    foreach ($component['slots'] as $slot) {
                        $markdown .= "- **{$slot['name']}**";
                        if ($slot['description']) {
                            $markdown .= ": {$slot['description']}";
                        }
                        $markdown .= "\n";
                    }
                    $markdown .= "\n";
                }
                
                // Examples
                if (!empty($component['examples'])) {
                    $markdown .= "#### Examples\n\n";
                    foreach ($component['examples'] as $example) {
                        $markdown .= "**{$example['title']}**\n\n";
                        $markdown .= "```twig\n{$example['code']}\n```\n\n";
                    }
                }
                
                // Usage notes
                if (!empty($component['usage'])) {
                    $markdown .= "#### Usage Notes\n\n";
                    foreach ($component['usage'] as $note) {
                        $markdown .= "- {$note}\n";
                    }
                    $markdown .= "\n";
                }
                
                $markdown .= "---\n\n";
            }
        }
        
        return $markdown;
    }
}