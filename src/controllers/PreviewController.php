<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use lindemannrock\componentmanager\ComponentManager;
use lindemannrock\logginglibrary\traits\LoggingTrait;
use yii\web\Response;

/**
 * Preview Controller - Render components in isolation
 *
 * @since 1.0.0
 */
class PreviewController extends Controller
{
    use LoggingTrait;

    /**
     * @inheritdoc
     */
    protected array|int|bool $allowAnonymous = ['render', 'iframe'];

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        $this->setLoggingHandle('component-manager');
    }
    
    /**
     * Render a component with given props
     *
     * @return Response
     * @since 1.0.0
     */
    public function actionRender(): Response
    {
        $request = Craft::$app->getRequest();
        $componentName = $request->getParam('component');
        $props = $request->getParam('props', []);
        $content = $request->getParam('content', '');
        $variant = $request->getParam('variant', 'default');
        
        if (!$componentName) {
            throw new \Exception('Component name is required');
        }
        
        $plugin = ComponentManager::getInstance();
        $component = $plugin->discovery->getComponent($componentName);
        
        if (!$component) {
            throw new \Exception('Component not found');
        }
        
        // Get component documentation for examples
        $documentation = $plugin->documentation->generateComponentDocumentation($component);
        
        // If a variant is selected, use its props
        if ($variant !== 'default' && isset($documentation['examples'])) {
            foreach ($documentation['examples'] as $example) {
                if ($example['id'] === $variant) {
                    $props = $example['props'] ?? [];
                    $content = $example['content'] ?? '';
                    break;
                }
            }
        }
        
        // Render the preview template
        return $this->renderTemplate('component-manager/preview/component', [
            'component' => $component,
            'props' => $props,
            'content' => $content,
            'variant' => $variant,
            'documentation' => $documentation,
            'isPreview' => true,
        ]);
    }
    
    /**
     * Render component preview in iframe
     *
     * @return Response
     * @since 1.0.0
     */
    public function actionIframe(): Response
    {
        $request = Craft::$app->getRequest();
        $componentName = $request->getParam('component');
        $propsJson = $request->getParam('props', '{}');
        $content = $request->getParam('content', '');
        $variant = $request->getParam('variant', 'default');
        
        // Debug: Log what we're receiving
        if (!$componentName) {
            // Try to get from query params directly
            $componentName = $request->getQueryParam('component');
        }
        
        if (!$componentName) {
            // Log the full URL for debugging
            $fullUrl = $request->getAbsoluteUrl();
            throw new \Exception("Component name is required. URL: " . $fullUrl);
        }
        
        // Parse props from JSON
        $props = [];
        if ($propsJson) {
            $props = json_decode($propsJson, true) ?? [];
        }
        
        // Debug logging
        $this->logDebug('Iframe request', [
            'component' => $componentName,
            'variant' => $variant,
            'propsJson' => $propsJson,
        ]);
        $this->logDebug('Parsed props', ['props' => $props]);
        
        // Get the plugin instance
        $plugin = ComponentManager::getInstance();
        
        // Force discovery of components first
        $components = $plugin->discovery->discoverComponents();
        
        // Get the component
        $component = $plugin->discovery->getComponent($componentName);
        
        if (!$component) {
            // List available components for debugging
            $available = array_keys($components);
            throw new \Exception("Component '{$componentName}' not found. Available: " . implode(', ', $available));
        }
        
        // Always try to load example data (including for default)
        $documentation = $plugin->documentation->generateComponentDocumentation($component);

        $this->logDebug('Looking for variant in examples', ['variant' => $variant]);

        if (isset($documentation['examples'])) {
            // For "default" variant, use the first example
            if ($variant === 'default' && !empty($documentation['examples'])) {
                $example = $documentation['examples'][0];
                $props = $example['props'] ?? [];
                $defaultContent = $example['content'] ?? '';
                $slots = $example['slots'] ?? [];
                $this->logDebug('Using first example for default', [
                    'props' => $props,
                    'content' => $defaultContent,
                    'slots' => $slots,
                ]);
            } else {
                // Find the matching example by ID
                foreach ($documentation['examples'] as $index => $example) {
                    $exampleId = $example['id'] ?? ('example-' . ($index + 1));
                    $this->logDebug('Checking example ID', ['exampleId' => $exampleId]);
                    if ($exampleId === $variant) {
                        $props = $example['props'] ?? [];
                        $defaultContent = $example['content'] ?? '';
                        $slots = $example['slots'] ?? [];
                        $this->logDebug('Found variant', [
                            'variant' => $variant,
                            'props' => $props,
                            'content' => $defaultContent,
                            'slots' => $slots,
                        ]);
                        break;
                    }
                }
            }
        }

        $this->logDebug('Final props being used', ['props' => $props]);

        // Determine default content for the component
        $defaultContent = $content ?: '';
        $slots = [];
        
        // Try to render using the component service directly for better control
        try {
            // Manually set the template mode to SITE to ensure we're looking in the right place
            $oldTemplateMode = Craft::$app->view->getTemplateMode();
            Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_SITE);
            
            // Add mock globals for components that depend on site context
            $mockGlobals = new \stdClass();
            $mockGlobals->siteUrl = 'https://example.com';
            Craft::$app->view->registerTwigExtension(new class($mockGlobals) extends \Twig\Extension\AbstractExtension {
                private $globals;
                public function __construct($globals)
                {
                    $this->globals = $globals;
                }
                public function getGlobals(): array
                {
                    return ['_globals' => $this->globals];
                }
            });
            
            // Provide required props with defaults if missing
            if ($componentName === 'forms/contact-card' && empty($props['title'])) {
                $props['title'] = 'Sample Contact Card';
            }
            
            $componentHtml = $plugin->components->render(
                $componentName,
                $props,
                $defaultContent,
                $slots
            );
            
            // Restore template mode
            Craft::$app->view->setTemplateMode($oldTemplateMode);
        } catch (\Exception $e) {
            // If rendering fails, try to provide helpful error message
            $errorMessage = $e->getMessage();
            
            // Check if it's a template not found error
            if (str_contains($errorMessage, 'Unable to find the template') || str_contains($errorMessage, 'not found')) {
                // Try to get the actual path that was attempted
                $attemptedPath = $component->relativePath ?? '_components/' . $componentName;
                $componentHtml = '<div style="padding: 20px; background: #fef3c7; color: #92400e; border: 1px solid #f59e0b; border-radius: 4px;">
                    <strong>Component template not found:</strong> ' . htmlspecialchars($componentName) . '<br>
                    <small>Looking for: ' . htmlspecialchars($attemptedPath) . '</small><br>
                    <small style="color: #666;">Error: ' . htmlspecialchars($errorMessage) . '</small>
                </div>';
            } else {
                $componentHtml = '<div style="padding: 20px; background: #fee; color: #c00; border: 1px solid #c00; border-radius: 4px;">
                    <strong>Error rendering component:</strong><br>' .
                    htmlspecialchars($errorMessage) .
                    '</div>';
            }
        }
        
        // Set response headers to prevent caching
        $response = Craft::$app->getResponse();
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // Set template mode to CP to find plugin templates
        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        
        try {
            // Render minimal template with just the component
            $html = $this->renderTemplate('component-manager/preview/iframe', [
                'componentHtml' => $componentHtml,
                'content' => $defaultContent,
                'props' => $props,
                'slots' => $slots,
                'variant' => $variant,
            ]);
        } catch (\Exception $e) {
            // If template not found, try with absolute path
            $pluginPath = Craft::getAlias('@plugins/component-manager/src/templates');
            Craft::$app->view->setTemplatesPath($pluginPath);
            
            $html = $this->renderTemplate('preview/iframe', [
                'componentHtml' => $componentHtml,
                'content' => $defaultContent,
                'props' => $props,
                'slots' => $slots,
                'variant' => $variant,
            ]);
        } finally {
            // Always restore template mode
            Craft::$app->view->setTemplateMode($oldMode);
        }
        
        return $html;
    }
}
