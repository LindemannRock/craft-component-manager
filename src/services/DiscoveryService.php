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
use lindemannrock\componentmanager\models\ComponentModel;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Discovery Service
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class DiscoveryService extends Component
{
    /**
     * @var array Discovered components cache
     */
    private array $_components = [];
    
    /**
     * @var bool Whether components have been discovered
     */
    private bool $_discovered = false;

    /**
     * Discover all components in configured paths
     *
     * @param bool $force Force re-discovery
     * @return array
     */
    public function discoverComponents(bool $force = false): array
    {
        if ($this->_discovered && !$force) {
            return $this->_components;
        }

        $this->_components = [];
        $plugin = ComponentManager::$plugin;
        $settings = $plugin->getSettings();
        $paths = $plugin->getComponentPaths();

        foreach ($paths as $path) {
            $this->discoverInPath($path);
        }

        $this->_discovered = true;
        
        // Cache the discovered components
        if ($settings->enableCache) {
            $plugin->cache->setComponents($this->_components);
        }

        return $this->_components;
    }

    /**
     * Discover components in a specific path
     *
     * @param string $path
     */
    private function discoverInPath(string $path): void
    {
        if (!is_dir($path)) {
            return;
        }

        $settings = ComponentManager::$plugin->getSettings();
        $extension = $settings->componentExtension;

        if ($settings->allowNesting) {
            // Recursive discovery for nested components
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === $extension) {
                    $this->processComponentFile($file, $path);
                }
            }
        } else {
            // Flat discovery
            $files = glob($path . '/*.' . $extension);
            foreach ($files as $file) {
                $this->processComponentFile(new \SplFileInfo($file), $path);
            }
        }
    }

    /**
     * Process a component file
     *
     * @param \SplFileInfo $file
     * @param string $basePath
     */
    private function processComponentFile(\SplFileInfo $file, string $basePath): void
    {
        $settings = ComponentManager::$plugin->getSettings();
        $filename = $file->getFilename();
        
        // Check ignore patterns
        foreach ($settings->ignorePatterns as $pattern) {
            if (fnmatch($pattern, $filename)) {
                return;
            }
        }

        // Check ignore folders
        $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPath());
        foreach ($settings->ignoreFolders as $folder) {
            if (str_contains($relativePath, $folder)) {
                return;
            }
        }

        // Create component model
        $component = $this->createComponentModel($file, $basePath);
        if ($component) {
            $this->_components[$component->name] = $component;
        }
    }

    /**
     * Create a component model from a file
     *
     * @param \SplFileInfo $file
     * @param string $basePath
     * @return ComponentModel|null
     */
    private function createComponentModel(\SplFileInfo $file, string $basePath): ?ComponentModel
    {
        $settings = ComponentManager::$plugin->getSettings();
        
        // Calculate component name
        $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
        $name = str_replace('.' . $settings->componentExtension, '', $relativePath);
        
        // Convert path separators to forward slashes for consistency
        $name = str_replace(DIRECTORY_SEPARATOR, '/', $name);
        
        // Check nesting depth
        if ($settings->maxNestingDepth > 0) {
            $depth = substr_count($name, '/');
            if ($depth > $settings->maxNestingDepth) {
                return null;
            }
        }

        $component = new ComponentModel();
        $component->name = $name;
        $component->path = $file->getPathname();
        $component->relativePath = $relativePath;
        $component->basePath = $basePath;
        
        // Parse component file for metadata
        $this->parseComponentMetadata($component);
        
        return $component;
    }

    /**
     * Parse component metadata from file
     *
     * @param ComponentModel $component
     */
    private function parseComponentMetadata(ComponentModel $component): void
    {
        $content = file_get_contents($component->path);
        
        // Parse description - store only in metadata to avoid duplication
        if (preg_match('/\{#.*?@description\s+([^\n@]+).*?#\}/s', $content, $matches)) {
            $component->description = trim($matches[1]);
        }
        
        // Parse category - store only in metadata to avoid duplication
        if (preg_match('/\{#.*?@category\s+([^\n@]+).*?#\}/s', $content, $matches)) {
            $component->category = trim($matches[1]);
        }
        
        // Parse props - handle multiple formats
        // Format 1: @props followed by JSON object
        if (preg_match('/{#\s*@props\s*(\{[\s\S]*?\})\s*(?=@\w+|#})/s', $content, $matches)) {
            $propsJson = $matches[1];
            try {
                $props = json_decode($propsJson, true);
                if (is_array($props)) {
                    $component->props = $props;
                }
            } catch (\Exception $e) {
                // Invalid JSON, skip
            }
        }
        // Format 2: Look for inline props documentation
        elseif (preg_match('/{#\s*@props\s*(.*?)#}/s', $content, $matches)) {
            $propsContent = $matches[1];
            // Try to parse as JSON
            try {
                $props = json_decode($propsContent, true);
                if (is_array($props)) {
                    $component->props = $props;
                }
            } catch (\Exception $e) {
                // Not valid JSON, skip
            }
        }
        
        // Parse slots from multiple sources
        $slots = [];
        
        // Method 1: Look for {% block %} tags
        if (preg_match_all('/{%\s*block\s+(\w+)\s*%}/', $content, $matches)) {
            $slots = array_merge($slots, $matches[1]);
        }
        
        // Method 2: Look for __slots references (new component format)
        if (preg_match_all('/\b__slots\.(\w+)\b/', $content, $matches)) {
            $slots = array_merge($slots, $matches[1]);
        }
        
        // Method 3: Look for @slot documentation with descriptions
        if (preg_match_all('/@slot\s+(\w+)(?:\s+-\s+([^\n@]+))?/', $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $slotName = $match[1];
                $slotDescription = isset($match[2]) ? trim($match[2]) : null;
                
                $slots[] = $slotName;
                
                // Store slot description in metadata
                if (!isset($component->metadata['slots'])) {
                    $component->metadata['slots'] = [];
                }
                $component->metadata['slots'][$slotName] = [
                    'name' => $slotName,
                    'description' => $slotDescription
                ];
            }
        }
        
        // Method 4: Check for default slot
        if (preg_match('/\b__default_slot\b/', $content)) {
            $slots[] = 'default';
        }
        
        // Remove duplicates and set
        $component->slots = array_unique($slots);
        
        // Parse extends
        if (preg_match('/{%\s*extends\s+["\']([^"\']+)["\']\s*%}/', $content, $matches)) {
            $component->extends = $matches[1];
        }
        
        // Parse additional metadata fields
        if (preg_match('/\{#.*?@version\s+([^\n@]+).*?#\}/s', $content, $matches)) {
            $component->metadata['version'] = trim($matches[1]);
        }
        
        if (preg_match('/\{#.*?@author\s+([^\n@]+).*?#\}/s', $content, $matches)) {
            $component->metadata['author'] = trim($matches[1]);
        }
        
        if (preg_match('/\{#.*?@tags\s+([^\n@]+).*?#\}/s', $content, $matches)) {
            $component->metadata['tags'] = array_map('trim', explode(',', $matches[1]));
        }
        
        // Parse examples
        if (preg_match_all('/@example\s+"([^"]+)"/', $content, $matches)) {
            $component->metadata['examples'] = $matches[1];
        }
    }

    /**
     * Get a component by name
     *
     * @param string $name
     * @return ComponentModel|null
     */
    public function getComponent(string $name): ?ComponentModel
    {
        $components = $this->discoverComponents();
        return $components[$name] ?? null;
    }

    /**
     * Get components by category
     *
     * @param string $category
     * @return array
     */
    public function getComponentsByCategory(string $category): array
    {
        $components = $this->discoverComponents();
        $filtered = [];
        
        foreach ($components as $component) {
            if ($component->category === $category) {
                $filtered[] = $component;
            }
        }
        
        return $filtered;
    }

    /**
     * Get all component categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        $components = $this->discoverComponents();
        $categories = [];
        
        foreach ($components as $component) {
            if ($component->category && !in_array($component->category, $categories)) {
                $categories[] = $component->category;
            }
        }
        
        sort($categories);
        return $categories;
    }

    /**
     * Clear discovery cache
     */
    public function clearCache(): void
    {
        $this->_components = [];
        $this->_discovered = false;
    }

    /**
     * Sync discovered components to database
     *
     * @return array
     */
    public function syncToDatabase(): array
    {
        $components = $this->discoverComponents(true); // Force rediscovery
        $results = ['created' => 0, 'updated' => 0, 'deleted' => 0, 'errors' => []];
        
        // Get all existing component names from filesystem
        $filesystemComponentNames = array_keys($components);
        
        // Get all existing component elements from database
        $existingElements = \lindemannrock\componentmanager\elements\Component::find()->all();
        
        // Track which components we've processed
        $processedNames = [];
        
        // Create or update components that exist in filesystem
        foreach ($components as $component) {
            try {
                // Create or update component element
                $element = \lindemannrock\componentmanager\elements\Component::find()
                    ->componentName($component->name)
                    ->one();
                
                if (!$element) {
                    $element = new \lindemannrock\componentmanager\elements\Component();
                    $isNew = true;
                } else {
                    $isNew = false;
                }
                
                // Set component data - keep in both places for filtering to work
                $element->componentName = $component->name;
                $element->title = $component->name;
                $element->path = $component->path;
                $element->relativePath = $component->relativePath;
                $element->category = $component->category;
                $element->description = $component->description;
                $element->props = $component->props;
                $element->slots = $component->slots;
                $element->metadata = $component->metadata;
                
                // Save element
                if (Craft::$app->getElements()->saveElement($element)) {
                    if ($isNew) {
                        $results['created']++;
                    } else {
                        $results['updated']++;
                    }
                    $processedNames[] = $component->name;
                } else {
                    $results['errors'][] = "Failed to save component: {$component->name}";
                }
                
            } catch (\Exception $e) {
                $results['errors'][] = "Error processing {$component->name}: " . $e->getMessage();
            }
        }
        
        // Delete components that exist in database but not in filesystem
        foreach ($existingElements as $element) {
            if (!in_array($element->componentName, $filesystemComponentNames)) {
                try {
                    if (Craft::$app->getElements()->deleteElement($element)) {
                        $results['deleted']++;
                    } else {
                        $results['errors'][] = "Failed to delete component: {$element->componentName}";
                    }
                } catch (\Exception $e) {
                    $results['errors'][] = "Error deleting {$element->componentName}: " . $e->getMessage();
                }
            }
        }
        
        // Clear all caches after sync to ensure CP reflects changes
        if ($results['deleted'] > 0 || $results['created'] > 0 || $results['updated'] > 0) {
            Craft::$app->getElements()->invalidateAllCaches();
            ComponentManager::$plugin->cache->clearCache();
            $this->clearCache();
        }
        
        return $results;
    }
}