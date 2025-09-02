# Twig Component Manager Configuration

## Configuration File

You can override plugin settings by creating a `twig-component-manager.php` file in your `config/` directory.

### Basic Setup

1. Copy `vendor/lindemannrock/twig-component-manager/src/config.php` to `config/twig-component-manager.php`
2. Modify the settings as needed

### Available Settings

```php
<?php
return [
    // Plugin settings
    'pluginName' => 'Twig Component Manager',
    
    // Component discovery paths
    'componentPaths' => [
        '_components',
        'components', 
        'src/components',
    ],
    
    // Default path for new components
    'defaultPath' => '_components',
    
    // Component organization
    'allowNesting' => true,
    'maxNestingDepth' => 3, // 0 = unlimited
    
    // Component files  
    'componentExtension' => 'twig',
    'defaultSlotName' => 'default',
    
    // Features
    'enablePropValidation' => true,
    'enableInheritance' => true,
    'enableDocumentation' => true,
    'allowInlineComponents' => true,
    
    // Caching
    'enableCache' => true,
    'cacheDuration' => 0, // 0 = no expiration
    
    // Development
    'enableDebugMode' => true,
    'enableUsageTracking' => false,
    
    // Control Panel
    'enableComponentLibrary' => true,
    'showComponentSource' => true,
    'enableLivePreview' => true,
    
    // Discovery filters
    'ignoreFolders' => [
        'node_modules',
        '.git',
        'vendor',
        'dist',
        'build',
    ],
    'ignorePatterns' => [
        '*.test.twig',
        '*.spec.twig',
        '_*',
    ],
    
    // Documentation metadata
    'metadataFields' => [
        'description',
        'category',
        'version',
        'author',
        'tags',
    ],
];
```

### Multi-Environment Configuration

Configure different settings per environment:

```php
<?php
use craft\helpers\App;

return [
    // Global settings
    '*' => [
        'pluginName' => 'Twig Component Manager',
        'componentPaths' => [
            '_components',
            'components',
        ],
        'enablePropValidation' => true,
    ],
    
    // Development environment
    'dev' => [
        'enableDebugMode' => true,
        'enableUsageTracking' => true,
        'enableCache' => false, // Disable cache for live development
        'showComponentSource' => true,
        'enableLivePreview' => true,
        'maxNestingDepth' => 0, // Unlimited nesting in dev
    ],
    
    // Staging environment
    'staging' => [
        'enableDebugMode' => false,
        'enableCache' => true,
        'cacheDuration' => 3600, // 1 hour
        'enableUsageTracking' => false,
    ],
    
    // Production environment
    'production' => [
        'enableDebugMode' => false,
        'enableCache' => true,
        'cacheDuration' => 86400, // 24 hours
        'enableUsageTracking' => false,
        'showComponentSource' => false, // Hide source in production
        'maxNestingDepth' => 3, // Limit nesting for performance
    ],
];
```

### Using Environment Variables

All settings support environment variables:

```php
return [
    'enableCache' => App::env('COMPONENT_CACHE') === 'true',
    'enableDebugMode' => App::env('COMPONENT_DEBUG') === 'true',
    'enablePropValidation' => App::env('COMPONENT_VALIDATION') === 'true',
    'componentPaths' => explode(',', App::env('COMPONENT_PATHS') ?: '_components,components'),
];
```

### Setting Descriptions

#### Plugin Settings

- **pluginName**: Display name for the plugin in Craft CP navigation

#### Component Discovery Settings

- **componentPaths**: Array of paths to scan for components (relative to templates folder)
- **defaultPath**: Default path when creating new components
- **componentExtension**: File extension for component files (default: 'twig')

#### Organization Settings

- **allowNesting**: Enable organizing components in nested folders
- **maxNestingDepth**: Maximum folder nesting depth (0 = unlimited)

#### Component File Settings

- **defaultSlotName**: Name for the default/unnamed slot

#### Feature Settings

- **enablePropValidation**: Enable prop type validation and required checks
- **enableInheritance**: Allow components to extend other components
- **enableDocumentation**: Parse and display component documentation
- **allowInlineComponents**: Allow defining components inline in templates

#### Caching Settings

- **enableCache**: Enable component caching for better performance
- **cacheDuration**: Cache duration in seconds (0 = no expiration)

#### Development Settings

- **enableDebugMode**: Show helpful error messages and debugging info
- **enableUsageTracking**: Track component usage statistics (disabled by default)

#### Control Panel Settings

- **enableComponentLibrary**: Enable the CP component library interface
- **showComponentSource**: Show component source code in CP
- **enableLivePreview**: Enable live component previews in CP

#### Discovery Filter Settings

- **ignoreFolders**: Array of folder names to ignore during component discovery
- **ignorePatterns**: Array of file patterns to ignore (supports wildcards)

#### Documentation Settings

- **metadataFields**: Array of metadata fields to parse from component comments

### Precedence

Settings are loaded in this order (later overrides earlier):

1. Default plugin settings
2. Database-stored settings (from CP)
3. Config file settings
4. Environment-specific config settings

### Performance Recommendations

For production environments:

```php
'production' => [
    'enableCache' => true,
    'cacheDuration' => 86400, // 24 hours
    'enableDebugMode' => false,
    'enableUsageTracking' => false,
    'showComponentSource' => false,
    'maxNestingDepth' => 3, // Limit nesting complexity
    'ignorePatterns' => [
        '*.test.twig',
        '*.spec.twig', 
        '*.dev.twig',
        '_*',
    ],
],
```

### Security Recommendations

```php
// Restrict component paths in production
'componentPaths' => App::env('COMPONENT_PATHS') ? 
    explode(',', App::env('COMPONENT_PATHS')) : 
    ['_components'], // Restrict to single secure path

// Disable potentially risky features in production
'allowInlineComponents' => App::env('ALLOW_INLINE_COMPONENTS') === 'true',
'showComponentSource' => App::env('SHOW_COMPONENT_SOURCE') === 'true',
```

### Advanced Configuration Examples

#### Simple Function Usage

```php
// Components are used via functions - no tag syntax needed
// {{ component('button', props) }} and {{ c('button', props) }} work automatically
```

#### Selective Feature Enabling

```php
// Minimal setup for simple projects
return [
    'enablePropValidation' => false,
    'enableInheritance' => false,
    'enableUsageTracking' => false,
    'allowInlineComponents' => false,
    'componentPaths' => ['_components'],
];
```

#### Development-Focused Setup

```php
'dev' => [
    'enableDebugMode' => true,
    'enableUsageTracking' => true,
    'showComponentSource' => true,
    'enableLivePreview' => true,
    'cacheDuration' => 0, // No cache expiration
    'metadataFields' => [
        'description',
        'category', 
        'version',
        'author',
        'tags',
        'status', // Custom field
        'complexity', // Custom field
    ],
];
```