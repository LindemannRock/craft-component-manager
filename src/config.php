<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

/**
 * Component Manager config.php
 *
 * This file exists only as a template for the Component Manager settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'component-manager.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    // Component paths relative to templates folder
    // These will be searched in order for components
    'componentPaths' => [
        '_components',      // templates/_components/
        'components',       // templates/components/
        'src/components',   // templates/src/components/
    ],
    
    // Default path for new components (when creating via CP)
    'defaultPath' => '_components',
    
    // Allow nested folder organization (e.g., forms/input.twig)
    'allowNesting' => true,
    
    // Maximum nesting depth (0 = unlimited)
    'maxNestingDepth' => 3,
    
    // Cache compiled components for better performance
    'enableCache' => true,
    
    // Cache duration in seconds (0 = until manually cleared)
    'cacheDuration' => 0,
    
    // Component tag prefix (e.g., x:component or c:component)
    'tagPrefix' => 'x',
    
    // Enable prop validation
    'enablePropValidation' => true,
    
    // Show helpful error messages in dev mode
    'enableDebugMode' => true,
    
    // Allow components to extend other components
    'enableInheritance' => true,
    
    // Enable component documentation generation
    'enableDocumentation' => true,
    
    // Component file extension
    'componentExtension' => 'twig',
    
    // Ignore these folders when discovering components
    'ignoreFolders' => [
        'node_modules',
        '.git',
        'vendor',
        'dist',
        'build',
    ],
    
    // Ignore files matching these patterns
    'ignorePatterns' => [
        '*.test.twig',
        '*.spec.twig',
        '_*',  // Files starting with underscore
    ],
    
    // Enable component usage tracking
    'enableUsageTracking' => false,
    
    // Allow inline components (defined in templates)
    'allowInlineComponents' => true,
    
    // Default slot name
    'defaultSlotName' => 'default',
    
    // Enable component library UI in CP
    'enableComponentLibrary' => true,
    
    // Show component source in library
    'showComponentSource' => true,
    
    // Enable live component preview
    'enableLivePreview' => true,
    
    // Custom component metadata fields
    'metadataFields' => [
        'description',
        'category',
        'version',
        'author',
        'tags',
    ],
];