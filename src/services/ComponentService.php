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
use lindemannrock\logginglibrary\traits\LoggingTrait;
use Twig\Error\SyntaxError;

/**
 * Component Service
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class ComponentService extends Component
{
    use LoggingTrait;

    /**
     * @var array Active component stack for debugging
     */
    private array $_componentStack = [];

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        $this->setLoggingHandle('component-manager');
    }

    /**
     * Render a component
     *
     * @param string $name Component name
     * @param array $props Component props
     * @param string|null $content Component content
     * @param array $slots Additional slots
     * @return string
     * @throws \Exception
     * @since 1.0.0
     */
    public function render(string $name, array $props = [], ?string $content = null, array $slots = []): string
    {
        $plugin = ComponentManager::$plugin;
        $settings = $plugin->getSettings();
        
        // Component name already contains slashes for folder paths (e.g., "forms/contact-card")
        // No normalization needed - the lexer preserves the original format
        
        // Get component model
        $component = $plugin->discovery->getComponent($name);
        
        if (!$component) {
            if ($settings->enableDebugMode && Craft::$app->getConfig()->getGeneral()->devMode) {
                throw new \Exception("Component '{$name}' not found. Available components: " .
                    implode(', ', array_keys($plugin->discovery->discoverComponents())));
            }
            return '';
        }
        
        // Validate props if enabled
        if ($settings->enablePropValidation) {
            $errors = $component->validateProps($props);
            if (!empty($errors)) {
                if ($settings->enableDebugMode && Craft::$app->getConfig()->getGeneral()->devMode) {
                    throw new \Exception("Component '{$name}' prop validation failed:\n" . implode("\n", $errors));
                }
                $this->logWarning('Component prop validation failed', [
                    'component' => $name,
                    'errors' => $errors,
                ]);
            }
        }
        
        // Apply default prop values
        $props = $component->applyDefaults($props);
        
        // Add component to stack for debugging
        $this->_componentStack[] = $name;
        
        try {
            // Prepare template path
            $templatePath = $this->getTemplatePath($component);
            
            // Prepare variables
            $defaultSlotVar = '__' . $settings->defaultSlotName . '_slot';
            $variables = array_merge($props, [
                '__component' => $component,
                '__content' => $content,
                '__slots' => $slots,
                $defaultSlotVar => $content, // Default slot content (configurable)
                '__default_slot' => $content, // Legacy alias for backwards compatibility
                'slot' => $content, // Alias for backwards compatibility
            ]);
            
            // Render the component template
            $html = Craft::$app->getView()->renderTemplate($templatePath, $variables);
            
            // Track usage if enabled
            if ($settings->enableUsageTracking) {
                $this->trackUsage($component);
            }
            
            return $html;
        } catch (\Exception $e) {
            // Remove from stack
            array_pop($this->_componentStack);

            if ($settings->enableDebugMode && Craft::$app->getConfig()->getGeneral()->devMode) {
                throw new \Exception("Error rendering component '{$name}': " . $e->getMessage(), 0, $e);
            }

            $this->logError('Error rendering component', [
                'component' => $name,
                'error' => $e->getMessage(),
            ]);
            return '';
        } finally {
            // Always remove from stack
            if (!empty($this->_componentStack)) {
                array_pop($this->_componentStack);
            }
        }
    }

    /**
     * Get the template path for a component
     *
     * @param ComponentModel $component
     * @return string
     */
    private function getTemplatePath(ComponentModel $component): string
    {
        $settings = ComponentManager::$plugin->getSettings();
        
        // Try each configured path
        foreach ($settings->componentPaths as $basePath) {
            $path = $basePath . '/' . $component->name . '.' . $settings->componentExtension;
            
            // Check if template exists
            $fullPath = Craft::$app->getPath()->getSiteTemplatesPath() . '/' . $path;
            if (file_exists($fullPath)) {
                return $path;
            }
        }
        
        // Fallback to component's stored path
        $templatesPath = Craft::$app->getPath()->getSiteTemplatesPath();
        return str_replace($templatesPath . '/', '', $component->path);
    }

    /**
     * Track component usage
     *
     * @param ComponentModel $component
     */
    private function trackUsage(ComponentModel $component): void
    {
        // Increment usage counter in cache
        $cacheKey = 'component-usage-' . md5($component->name);
        $cached = Craft::$app->getCache()->get($cacheKey);
        $count = ($cached === false) ? 0 : (int)$cached;
        $count++;
        Craft::$app->getCache()->set($cacheKey, $count, 86400); // Cache for 24 hours
    }

    /**
     * Get component usage statistics
     *
     * @return array
     * @since 1.0.0
     */
    public function getUsageStats(): array
    {
        $stats = [];
        $components = ComponentManager::$plugin->discovery->discoverComponents();
        
        foreach ($components as $component) {
            $cacheKey = 'component-usage-' . md5($component->name);
            $count = Craft::$app->getCache()->get($cacheKey) ?? 0;
            $stats[$component->name] = $count;
        }
        
        arsort($stats);
        return $stats;
    }

    /**
     * Get current component stack (for debugging)
     *
     * @return array
     * @since 1.0.0
     */
    public function getComponentStack(): array
    {
        return $this->_componentStack;
    }

    /**
     * Validate component syntax
     *
     * @param string $name
     * @return array Validation results
     * @since 1.0.0
     */
    public function validateComponent(string $name): array
    {
        $results = [
            'valid' => true,
            'errors' => [],
            'warnings' => [],
        ];
        
        $component = ComponentManager::$plugin->discovery->getComponent($name);
        
        if (!$component) {
            $results['valid'] = false;
            $results['errors'][] = "Component '{$name}' not found";
            return $results;
        }
        
        // Check if file exists
        if (!file_exists($component->path)) {
            $results['valid'] = false;
            $results['errors'][] = "Component file not found: {$component->path}";
            return $results;
        }
        
        // Try to parse the template
        try {
            $content = file_get_contents($component->path);
            $twig = Craft::$app->getView()->getTwig();
            $twig->parse($twig->tokenize(new \Twig\Source($content, $component->name)));
        } catch (SyntaxError $e) {
            $results['valid'] = false;
            $results['errors'][] = "Syntax error: " . $e->getMessage();
        } catch (\Exception $e) {
            $results['valid'] = false;
            $results['errors'][] = "Parse error: " . $e->getMessage();
        }
        
        // Check for unused props
        if (!empty($component->props)) {
            $content = file_get_contents($component->path);
            foreach (array_keys($component->props) as $propName) {
                if (!str_contains($content, $propName)) {
                    $results['warnings'][] = "Prop '{$propName}' is defined but never used";
                }
            }
        }
        
        return $results;
    }
}
