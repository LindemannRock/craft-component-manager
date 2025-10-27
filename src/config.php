<?php
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
    // Global settings
    '*' => [
        // ========================================
        // GENERAL SETTINGS
        // ========================================
        // Basic plugin configuration

        'pluginName' => 'Component Manager',

        // Logging Settings
        'logLevel' => 'error',             // Log level: 'debug', 'info', 'warning', 'error'


        // ========================================
        // COMPONENT SETTINGS
        // ========================================
        // Component paths, file organization, and naming conventions

        // Component Paths
        // Paths relative to templates folder, searched in order for components
        'componentPaths' => [
            '_components',      // templates/_components/
            'components',       // templates/components/
            'src/components',   // templates/src/components/
        ],

        // Default Path
        // Default path for new components when creating via Control Panel
        'defaultPath' => '_components',

        // File Organization
        'allowNesting' => true,            // Allow nested folder organization (e.g., forms/input.twig)
        'maxNestingDepth' => 3,            // Maximum nesting depth (0 = unlimited)

        // Component Naming
        'componentExtension' => 'twig',    // Component file extension
        'tagPrefix' => 'x',                // Component tag prefix (e.g., x:component or c:component)
        'defaultSlotName' => 'default',    // Default slot name for component content


        // ========================================
        // FEATURE SETTINGS
        // ========================================
        // Component features and capabilities

        // Validation & Type Safety
        'enablePropValidation' => true,    // Enable prop validation for components

        // Component Capabilities
        'enableInheritance' => true,       // Allow components to extend other components
        'allowInlineComponents' => true,   // Allow inline components (defined in templates)

        // Documentation & Tracking
        'enableDocumentation' => true,     // Enable component documentation generation
        'enableUsageTracking' => false,    // Enable component usage tracking

        // Custom Metadata
        // Custom component metadata fields for documentation
        'metadataFields' => [
            'description',
            'category',
            'version',
            'author',
            'tags',
        ],


        // ========================================
        // INTERFACE SETTINGS
        // ========================================
        // Control panel display and library options

        'enableComponentLibrary' => true,  // Enable component library UI in Control Panel
        'showComponentSource' => true,     // Show component source code in library
        'enableLivePreview' => true,       // Enable live component preview in Control Panel
        'itemsPerPage' => 100,             // Number of components per page (10-500)


        // ========================================
        // CACHE SETTINGS
        // ========================================
        // Performance and caching configuration

        'enableCache' => true,             // Cache compiled components for better performance
        'cacheDuration' => 0,              // Cache duration in seconds (0 = until manually cleared)


        // ========================================
        // ADVANCED SETTINGS
        // ========================================
        // File exclusions, debugging, and advanced options

        // Debug Mode
        'enableDebugMode' => true,         // Show helpful error messages (recommended for development)

        // Ignore Folders
        // Folders to exclude when discovering components
        'ignoreFolders' => [
            'node_modules',
            '.git',
            'vendor',
            'dist',
            'build',
        ],

        // Ignore Patterns
        // File patterns to exclude from component discovery
        'ignorePatterns' => [
            '*.test.twig',
            '*.spec.twig',
            '_*',  // Files starting with underscore
        ],
    ],

    // Dev environment settings
    'dev' => [
        'logLevel' => 'debug',             // More verbose logging in dev
        'enableCache' => false,            // No cache - see changes immediately
        'enableDebugMode' => true,         // Show all debug messages
        'enableUsageTracking' => true,     // Track usage during development
    ],

    // Staging environment settings
    'staging' => [
        'logLevel' => 'info',              // Moderate logging in staging
        'enableCache' => true,
        'cacheDuration' => 3600,           // 1 hour - balance testing/performance
        'enableDebugMode' => true,         // Keep debug enabled for testing
    ],

    // Production environment settings
    'production' => [
        'logLevel' => 'error',             // Only errors in production
        'enableCache' => true,
        'cacheDuration' => 0,              // Cache until manually cleared - maximum performance
        'enableDebugMode' => false,        // Hide debug messages in production
        'enableUsageTracking' => false,    // Disable usage tracking in production
    ],
];
