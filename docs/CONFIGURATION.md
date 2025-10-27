# Component Manager Configuration

## Configuration File

You can override plugin settings by creating a `component-manager.php` file in your `config/` directory.

### Basic Setup

1. Copy `vendor/lindemannrock/component-manager/src/config.php` to `config/component-manager.php`
2. Modify the settings as needed

### Available Settings

```php
<?php
return [
    // Plugin settings
    'pluginName' => 'Component Manager',
    
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
    'tagPrefix' => 'x',
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
    'itemsPerPage' => 100,

    // Logging
    'logLevel' => 'error',

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
        'pluginName' => 'Component Manager',
        'componentPaths' => [
            '_components',
            'components',
        ],
        'enablePropValidation' => true,
    ],
    
    // Development environment
    'dev' => [
        'logLevel' => 'debug',
        'enableCache' => false,
        'enableDebugMode' => true,
        'enableUsageTracking' => true,
    ],

    // Staging environment
    'staging' => [
        'logLevel' => 'info',
        'enableCache' => true,
        'cacheDuration' => 3600,
        'enableDebugMode' => true,
    ],

    // Production environment
    'production' => [
        'logLevel' => 'error',
        'enableCache' => true,
        'cacheDuration' => 0,
        'enableDebugMode' => false,
        'enableUsageTracking' => false,
    ],
];
```

### Using Environment Variables

All settings support environment variables:

```php
use craft\helpers\App;

return [
    'enableCache' => (bool)App::env('COMPONENT_CACHE') ?: true,
    'enableDebugMode' => (bool)App::env('COMPONENT_DEBUG') ?: true,
    'enablePropValidation' => (bool)App::env('COMPONENT_VALIDATION') ?: true,
    'componentPaths' => explode(',', App::env('COMPONENT_PATHS') ?: '_components,components'),
    'logLevel' => App::env('COMPONENT_LOG_LEVEL') ?: 'error',
];
```

**Important:**
- ✅ Use `App::env('VAR_NAME')` - Craft 5 recommended approach
- ❌ Don't use `getenv('VAR_NAME')` - Not thread-safe
- ✅ Always import: `use craft\helpers\App;`

### Setting Descriptions

#### Plugin Settings

- **pluginName**: Display name for the plugin in Craft CP navigation
  - **Type:** `string`
  - **Default:** `'Component Manager'`

#### Component Discovery Settings

- **componentPaths**: Array of paths to scan for components (relative to templates folder)
  - **Type:** `array`
  - **Default:** `['_components', 'components', 'src/components']`
  - **Note:** Searched in order, first match wins
- **defaultPath**: Default path when creating new components
  - **Type:** `string`
  - **Default:** `'_components'`

#### Organization Settings

- **allowNesting**: Enable organizing components in nested folders
  - **Type:** `bool`
  - **Default:** `true`
- **maxNestingDepth**: Maximum folder nesting depth (0 = unlimited)
  - **Type:** `int`
  - **Default:** `3`

#### Component File Settings

- **componentExtension**: File extension for component files
  - **Type:** `string`
  - **Default:** `'twig'`
- **tagPrefix**: Component tag prefix (e.g., 'x' creates x:component or 'c' creates c:component)
  - **Type:** `string`
  - **Default:** `'x'`
- **defaultSlotName**: Name for the default/unnamed slot
  - **Type:** `string`
  - **Default:** `'default'`

#### Feature Settings

- **enablePropValidation**: Enable prop type validation and required checks
  - **Type:** `bool`
  - **Default:** `true`
- **enableInheritance**: Allow components to extend other components
  - **Type:** `bool`
  - **Default:** `true`
- **enableDocumentation**: Parse and display component documentation
  - **Type:** `bool`
  - **Default:** `true`
- **allowInlineComponents**: Allow defining components inline in templates
  - **Type:** `bool`
  - **Default:** `true`

#### Caching Settings

- **enableCache**: Enable component caching for better performance
  - **Type:** `bool`
  - **Default:** `true`
- **cacheDuration**: Cache duration in seconds (0 = no expiration)
  - **Type:** `int`
  - **Default:** `0` (no expiration)

#### Development Settings

- **enableDebugMode**: Show helpful error messages and debugging info
  - **Type:** `bool`
  - **Default:** `true`
- **enableUsageTracking**: Track component usage statistics
  - **Type:** `bool`
  - **Default:** `false`

#### Control Panel Settings

- **enableComponentLibrary**: Enable the CP component library interface
  - **Type:** `bool`
  - **Default:** `true`
- **showComponentSource**: Show component source code in CP
  - **Type:** `bool`
  - **Default:** `true`
- **enableLivePreview**: Enable live component previews in CP
  - **Type:** `bool`
  - **Default:** `true`
- **itemsPerPage**: Number of components per page in CP
  - **Type:** `int`
  - **Range:** `10-500`
  - **Default:** `100`

#### Logging Settings

- **logLevel**: What types of messages to log
  - **Type:** `string`
  - **Options:** `'debug'`, `'info'`, `'warning'`, `'error'`
  - **Default:** `'error'`
  - **Note:** Debug level requires Craft's `devMode` to be enabled

#### Discovery Filter Settings

- **ignoreFolders**: Array of folder names to ignore during component discovery
  - **Type:** `array`
  - **Default:** `['node_modules', '.git', 'vendor', 'dist', 'build']`
- **ignorePatterns**: Array of file patterns to ignore (supports wildcards)
  - **Type:** `array`
  - **Default:** `['*.test.twig', '*.spec.twig', '_*']`

#### Documentation Settings

- **metadataFields**: Array of metadata fields to parse from component comments
  - **Type:** `array`
  - **Default:** `['description', 'category', 'version', 'author', 'tags']`

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
    'logLevel' => 'error',
    'enableCache' => true,
    'cacheDuration' => 0, // Cache until manually cleared - maximum performance
    'enableDebugMode' => false,
    'enableUsageTracking' => false,
],
```

### Security Recommendations

```php
use craft\helpers\App;

// Restrict component paths in production
'componentPaths' => App::env('COMPONENT_PATHS') ?
    explode(',', App::env('COMPONENT_PATHS')) :
    ['_components'], // Restrict to single secure path

// Disable potentially risky features in production
'allowInlineComponents' => (bool)App::env('ALLOW_INLINE_COMPONENTS') ?: false,
'showComponentSource' => (bool)App::env('SHOW_COMPONENT_SOURCE') ?: false,
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