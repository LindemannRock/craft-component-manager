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
use lindemannrock\componentmanager\ComponentManager;
use lindemannrock\logginglibrary\traits\LoggingTrait;
use yii\web\Response;

/**
 * Components Controller
 */
class ComponentsController extends Controller
{
    use LoggingTrait;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        $this->setLoggingHandle('component-manager');
    }

    /**
     * Components index - list all discovered components using element index
     */
    public function actionIndex(): Response
    {
        $plugin = ComponentManager::getInstance();
        
        // Force discovery of components
        $plugin->discovery->discoverComponents();
        
        // Use Craft's element index
        return $this->renderTemplate('component-manager/components/_index', [
            'plugin' => $plugin,
            'title' => 'Components',
            'pluginName' => $plugin->name,
            'elementType' => \lindemannrock\componentmanager\elements\Component::class,
        ]);
    }
    
    /**
     * Documentation - view component documentation
     */
    public function actionDocumentation(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        // Check if documentation is enabled
        if (!$settings->enableDocumentation) {
            Craft::$app->getSession()->setError(Craft::t('component-manager', 'Component documentation is disabled. Enable it in the plugin settings.'));
            return $this->redirect('component-manager');
        }
        
        // Generate documentation
        $documentation = $plugin->documentation->generateAllDocumentation();
        
        return $this->renderTemplate('component-manager/documentation/index', [
            'plugin' => $plugin,
            'documentation' => $documentation,
            'title' => 'Component Documentation',
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Component detail page
     */
    public function actionDetail(string $componentName): Response
    {
        $plugin = ComponentManager::getInstance();
        
        // Get the component
        $component = $plugin->discovery->getComponent($componentName);
        
        if (!$component) {
            throw new \yii\web\NotFoundHttpException('Component not found');
        }
        
        // Generate documentation for this specific component
        $documentation = $plugin->documentation->generateComponentDocumentation($component);
        
        // Debug: check what examples were found
        if ($componentName === 'forms/contact-card') {
            $this->logDebug('Contact-card documentation', ['documentation' => $documentation]);
        }
        
        // Read the component source
        $source = file_get_contents($component->path);
        
        return $this->renderTemplate('component-manager/components/detail', [
            'plugin' => $plugin,
            'component' => $component,
            'documentation' => $documentation,
            'source' => $source,
            'title' => $component->name,
            'pluginName' => $plugin->name,
        ]);
    }
    
    /**
     * Export documentation as markdown
     */
    public function actionExportDocumentation(): Response
    {
        $plugin = ComponentManager::getInstance();
        $settings = $plugin->getSettings();
        
        // Check if documentation is enabled
        if (!$settings->enableDocumentation) {
            Craft::$app->getSession()->setError(Craft::t('component-manager', 'Component documentation is disabled. Enable it in the plugin settings.'));
            return $this->redirect('component-manager');
        }
        
        // Generate markdown documentation
        $markdown = $plugin->documentation->generateMarkdownDocumentation();
        
        // Create response with markdown file
        $response = Craft::$app->getResponse();
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'text/markdown');
        $response->headers->set('Content-Disposition', 'attachment; filename="component-documentation.md"');
        $response->content = $markdown;
        
        return $response;
    }
}
