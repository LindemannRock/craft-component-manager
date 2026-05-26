<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2026 LindemannRock
 */

return [
    // Plugin meta
    'Component Manager' => 'Component Manager',
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organize components, validate props, and document your design system from one control panel workspace.',
    'Open Component Manager' => 'Open Component Manager',

    // Navigation
    'Components' => 'Components',
    'Documentation' => 'Documentation',
    'Logs' => 'Logs',
    'Settings' => 'Settings',
    'View logs' => 'View logs',
    'View system logs' => 'View system logs',
    'Download system logs' => 'Download system logs',

    // Common
    'Yes' => 'Yes',
    'No' => 'No',
    'Enabled' => 'Enabled',
    'Disabled' => 'Disabled',
    'Default' => 'Default',
    'Required' => 'Required',
    'Example' => 'Example',
    'Name' => 'Name',
    'Type' => 'Type',
    'Description' => 'Description',
    'Copy' => 'Copy',
    'Copy Code' => 'Copy Code',
    'Copy Usage' => 'Copy Usage',
    'Apply Changes' => 'Apply Changes',
    'Configure Paths' => 'Configure Paths',
    'Go to Features Settings' => 'Go to Features Settings',

    // Element
    'Component' => 'Component',
    'All Components' => 'All Components',
    'Handle' => 'Handle',
    'Category' => 'Category',
    'Path' => 'Path',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Settings saved.',
    'Could not save settings.' => 'Could not save settings.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'Component documentation is disabled. Enable it in the plugin settings.',
    'Component cache cleared successfully.' => 'Component cache cleared successfully.',

    // Settings: General
    'General' => 'General',
    'General Settings' => 'General Settings',
    'Default Slot Name' => 'Default Slot Name',
    'Name of the default slot for component content' => 'Name of the default slot for component content',
    'Logging Settings' => 'Logging Settings',

    // Settings: Discovery
    'Discovery' => 'Discovery',
    'Discovery Settings' => 'Discovery Settings',
    'Allow Nesting' => 'Allow Nesting',
    'Allow nested folder organization for components' => 'Allow nested folder organization for components',
    'Max Nesting Depth' => 'Max Nesting Depth',
    'Maximum folder nesting depth (0 = unlimited)' => 'Maximum folder nesting depth (0 = unlimited)',
    'Ignore Folders' => 'Ignore Folders',
    'Folders to ignore when discovering components (one per line)' => 'Folders to ignore when discovering components (one per line)',
    'Ignore Patterns' => 'Ignore Patterns',
    'File patterns to ignore when discovering components (one per line)' => 'File patterns to ignore when discovering components (one per line)',

    // Settings: Features
    'Features' => 'Features',
    'Enable Prop Validation' => 'Enable Prop Validation',
    'Validate component props based on their definitions' => 'Validate component props based on their definitions',
    'Enable Cache' => 'Enable Cache',
    'Cache component discovery for better performance' => 'Cache component discovery for better performance',
    'Cache Duration' => 'Cache Duration',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'How long to cache component data, in seconds (0 = until manually cleared)',
    'Enable Debug Mode' => 'Enable Debug Mode',
    'Show helpful error messages in dev mode' => 'Show helpful error messages in dev mode',
    'Enable Usage Tracking' => 'Enable Usage Tracking',
    'Track component usage statistics' => 'Track component usage statistics',
    'Enable Inheritance' => 'Enable Inheritance',
    'Allow components to extend other components' => 'Allow components to extend other components',
    'Enable Documentation' => 'Enable Documentation',
    'Enable automatic documentation generation for components' => 'Enable automatic documentation generation for components',
    'Allow Inline Components' => 'Allow Inline Components',
    'Allow components to be defined inline in templates' => 'Allow components to be defined inline in templates',

    // Settings: Paths & Files
    'Paths & Files' => 'Paths & Files',
    'Component Paths' => 'Component Paths',
    'Paths to search for components (one per line, relative to templates folder)' => 'Paths to search for components (one per line, relative to templates folder)',
    'Default Path' => 'Default Path',
    'Default path for components (relative to templates folder)' => 'Default path for components (relative to templates folder)',
    'Component Extension' => 'Component Extension',
    'File extension for component files' => 'File extension for component files',

    // Settings: Component Library
    'Component Library' => 'Component Library',
    'Enable Component Library' => 'Enable Component Library',
    'Enable the component library UI in the Control Panel' => 'Enable the component library UI in the Control Panel',
    'Show Component Source' => 'Show Component Source',
    'Show component source code in the library' => 'Show component source code in the library',
    'Enable Live Preview' => 'Enable Live Preview',
    'Enable live component preview in the library' => 'Enable live component preview in the library',
    'Metadata Fields' => 'Metadata Fields',
    'Custom metadata fields for components (one per line)' => 'Custom metadata fields for components (one per line)',

    // Settings: Interface
    'Interface' => 'Interface',
    'Interface Settings' => 'Interface Settings',

    // Components: Index
    'Discovered Components' => 'Discovered Components',
    'View Documentation' => 'View Documentation',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'No components found. Make sure your component paths are configured correctly in Settings.',

    // Components: Detail
    'Live Preview' => 'Live Preview',
    'Examples' => 'Examples',
    'Source Code' => 'Source Code',
    'Usage Notes' => 'Usage Notes',
    'Edit Props' => 'Edit Props',

    // Component Library (Documentation page)
    'Grid View' => 'Grid View',
    'List View' => 'List View',
    'Export Docs' => 'Export Docs',
    'Quick Navigation' => 'Quick Navigation',
    'Preview' => 'Preview',
    'Code' => 'Code',
    'Component Preview' => 'Component Preview',
    'No Components Found' => 'No Components Found',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.',

    // Utilities (Maintenance)
    'Maintenance' => 'Maintenance',
    'Component Cache' => 'Component Cache',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Clear the component discovery cache to force re-discovery of all components.',
    'Clear Component Cache' => 'Clear Component Cache',
    'Are you sure you want to clear the component cache?' => 'Are you sure you want to clear the component cache?',
    'Cache Duration:' => 'Cache Duration:',
    'Until manually cleared' => 'Until manually cleared',
    'seconds' => 'seconds',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'Component caching is currently disabled. Enable it in the Features settings.',
    'Usage Statistics' => 'Usage Statistics',
    'Clear component usage statistics and tracking data.' => 'Clear component usage statistics and tracking data.',
    'Clear Usage Statistics' => 'Clear Usage Statistics',
    'Are you sure you want to clear all usage statistics?' => 'Are you sure you want to clear all usage statistics?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Usage tracking is currently disabled. Enable it in the Features settings.',
    'Component Discovery' => 'Component Discovery',
    'Force re-discovery of all components from configured paths.' => 'Force re-discovery of all components from configured paths.',
    'Re-discover Components' => 'Re-discover Components',
    'Currently searching in:' => 'Currently searching in:',
    'System Information' => 'System Information',
    'Information about the Component Manager system.' => 'Information about the Component Manager system.',
    'Plugin Version' => 'Plugin Version',
    'Schema Version' => 'Schema Version',
    'Components Discovered' => 'Components Discovered',
    'components' => 'components',
    'Cache Status' => 'Cache Status',
    'Usage Tracking' => 'Usage Tracking',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.',
];
