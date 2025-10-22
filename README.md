# Component Manager for Craft CMS

[![Latest Version](https://img.shields.io/packagist/v/lindemannrock/craft-component-manager.svg)](https://packagist.org/packages/lindemannrock/craft-component-manager)
[![Craft CMS](https://img.shields.io/badge/Craft%20CMS-5.0+-orange.svg)](https://craftcms.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net/)
[![License](https://img.shields.io/packagist/l/lindemannrock/craft-component-manager.svg)](LICENSE)

Advanced component management plugin for Craft CMS 5.x with comprehensive Control Panel interface, automatic component discovery, rich documentation parsing, and professional preview system.

## Features

- ✅ **Comprehensive CP Interface** - Full Control Panel integration with searchable component library
- ✅ **Automatic Discovery** - Scans and catalogs all components from filesystem to database
- ✅ **Rich Documentation Parsing** - Extracts @description, @category, @props, @slots, @examples from component comments
- ✅ **Professional Preview System** - Live component previews with resizable viewport and device presets
- ✅ **Smart Component Organization** - Category-based filtering and sorting in sidebar
- ✅ **Database Storage** - Components stored as Craft Elements for efficient querying and management
- ✅ **Folder Organization** - Organize components in nested folders (e.g., `forms/input.twig`)
- ✅ **Function-Based Syntax** - Clean component functions: `{{ component('button', {label: 'Click'}) }}`
- ✅ **Prop Validation** - Define and validate component props with types and defaults
- ✅ **Multiple Slots** - Support for named slots with descriptions
- ✅ **Console Commands** - Sync and refresh components via CLI
- ✅ **Usage Tracking** - Track component usage and statistics

## Development Status

⚠️ **Active Development** - This plugin is currently in active development with some features still being refined:

- **Documentation Generation** - Advanced doc parsing and CP presentation being finalized
- **Live Preview System** - Component preview interface still in development
- **Usage Analytics** - Component usage tracking and statistics in development
- **Performance Optimization** - Caching and performance features being refined

Core component functionality (parsing, rendering, prop validation) is stable and ready for use.

## Requirements

- Craft CMS 5.0 or greater
- PHP 8.2 or greater

## Installation

### Via Composer

```bash
cd /path/to/project
composer require lindemannrock/craft-component-manager
./craft plugin/install component-manager
```

### Using DDEV

```bash
cd /path/to/project
ddev composer require lindemannrock/craft-component-manager
ddev craft plugin/install component-manager
```

### Via Control Panel

In the Control Panel, go to Settings → Plugins and click "Install" for Component Manager.

## Configuration

### Config File

Create a `config/component-manager.php` file to override default settings:

```php
<?php
return [
    // Component discovery paths
    'componentPaths' => [
        '_components',
        'components',
        'src/components',
    ],

    // Basic settings
    'defaultPath' => '_components',
    'tagPrefix' => 'x',
    'enablePropValidation' => true,
    'enableCache' => true,

    // Production optimizations
    'production' => [
        'enableDebugMode' => false,
        'cacheDuration' => 86400,
        'showComponentSource' => false,
    ],
];
```

See [Configuration Documentation](docs/CONFIGURATION.md) for all available options.

## Usage

### Basic Component

Create a component at `templates/_components/button.twig`:

```twig
{#
    @description A simple button component
    @category Forms
    @props {
        "label": {
            "type": "string",
            "required": true
        },
        "variant": {
            "type": "string",
            "default": "primary",
            "enum": ["primary", "secondary"]
        }
    }
#}

<button class="btn btn-{{ variant }}">
    {{ label }}
</button>
```

Use it in your templates:

```twig
{# Function syntax #}
{{ component('button', {label: 'Click me', variant: 'primary'}) }}

{# Short alias #}
{{ c('button', {variant: 'secondary'}, '<span>Custom content</span>') }}

{# With content as third parameter #}
{{ component('button', {variant: 'primary'}, 'Button Text') }}
```

### Nested Components

Organize components in folders:

```
templates/_components/
├── forms/
│   ├── input.twig
│   ├── select.twig
│   └── textarea.twig
├── cards/
│   ├── product.twig
│   └── article.twig
└── layout/
    ├── container.twig
    └── grid.twig
```

Use with folder paths:

```twig
{{ component('forms/input', {name: 'email', type: 'email'}) }}
{{ c('cards/product', {product: entry}) }}
{{ component('layout/container', {width: 'max-w-6xl'}, 'Content here') }}
```

### Component with Rich Documentation

Create well-documented components that appear beautifully in the CP:

```twig
{#
    @description A fully-featured button component showcasing all documentation capabilities
    @category UI Components
    @version 2.0.0
    @author LindemannRock
    @tags button, interactive, ui, showcase, accessibility

    @slot icon - Optional icon to display before the button text
    @slot endIcon - Optional icon to display after the button text
    @slot tooltip - Tooltip content to show on hover

    @example "Primary Button"
    {{ component('showcase-button', {
        label: 'Save Changes',
        variant: 'primary'
    }) }}

    @example "Button with Icon"
    {{ component('showcase-button', {
        label: 'Download Report',
        variant: 'secondary',
        size: 'large'
    }, iconSvg) }}

    @props {
        "label": {
            "type": "string",
            "required": true,
            "description": "Button text to display"
        },
        "variant": {
            "type": "string",
            "default": "primary",
            "enum": ["primary", "secondary", "danger"],
            "description": "Visual style variant"
        }
    }
#}

<button class="btn btn-{{ variant ?? 'primary' }}">
    {{ __slots.icon ?? '' }}
    {{ label ?? __content ?? 'Button' }}
    {{ __slots.endIcon ?? '' }}
</button>
```

Use with slots (using functions):

```twig
{# For components with slots, content is passed as third parameter #}
{{ component('card', {title: 'Card Title'}, cardContent) }}

{# Where cardContent variable contains the card body #}
{% set cardContent %}
    <p>This is the main content</p>
    <button>Action</button>
{% endset %}
```

### Prop Validation

Define component props with validation:

```twig
{#
    @props {
        "title": {
            "type": "string",
            "required": true,
            "description": "Component title"
        },
        "count": {
            "type": "integer",
            "default": 0,
            "description": "Item count"
        },
        "status": {
            "type": "string",
            "enum": ["active", "inactive", "pending"],
            "default": "active"
        },
        "pattern": {
            "type": "string",
            "pattern": "/^[A-Z][0-9]+$/",
            "description": "Must start with uppercase letter followed by numbers"
        }
    }
#}
```

### Using Functions

The plugin provides helper functions:

```twig
{# Render component via function #}
{{ component('button', {label: 'Click'}) }}

{# Short alias #}
{{ c('forms/input', {name: 'email'}) }}

{# Check if component exists #}
{% if hasComponent('cards/product') %}
    {{ c('cards/product', {product: entry}) }}
{% endif %}

{# Get component props #}
{% set props = componentProps('button') %}

{# Get component slots #}
{% set slots = componentSlots('card') %}
```

### Template Variables

Access component information:

```twig
{# Get all components #}
{% set components = craft.componentManager.all() %}

{# Get component by name #}
{% set button = craft.componentManager.get('button') %}

{# Get components by category #}
{% set formComponents = craft.componentManager.byCategory('Forms') %}

{# Get usage statistics #}
{% set usage = craft.componentManager.usage() %}

{# Validate a component #}
{% set validation = craft.componentManager.validate('button') %}
```

## Advanced Features

### Component Inheritance

Components can extend other components:

```twig
{# _components/base/button.twig #}
{#
    @props {
        "label": {"type": "string", "required": true},
        "class": {"type": "string"}
    }
#}
<button class="btn {{ class }}">{{ label }}</button>
```

```twig
{# _components/primary-button.twig #}
{% extends "_components/base/button.twig" %}

{% block class %}btn-primary {{ parent() }}{% endblock %}
```

### Inline Components

Define components inline in templates:

```twig
{% component alert %}
    <div class="alert alert-{{ type ?? 'info' }}">
        {{ content }}
    </div>
{% endcomponent %}

{# Use the inline component #}
{{ component('alert', {type: 'warning'}, 'This is a warning message') }}
```

## Control Panel Features

### Component Library

Access the component library at **Components** in the Control Panel to:

- **Browse Components** - View all discovered components in a sortable table
- **Filter by Category** - Use sidebar to filter components by @category (Forms, UI Components, etc.)
- **Search Components** - Full-text search across component names, descriptions, and categories
- **View Details** - Click component names to access detailed preview pages
- **Sort by Any Column** - Sort by Name, Description, Category, Props count, or Slots count

### Component Preview Pages

Each component has a dedicated preview page with:

- **Live Preview** - Interactive component preview with sample data
- **Resizable Viewport** - Drag to resize preview, test mobile/tablet/desktop breakpoints
- **Device Presets** - Quick buttons for mobile (375px), tablet (768px), desktop views
- **Examples Tab** - All @example definitions with copy-to-clipboard functionality
- **Props Tab** - Detailed prop documentation with types, defaults, and descriptions
- **Slots Tab** - Available slots with usage examples
- **Source Code Tab** - Complete component source code

### Console Commands

Manage components via CLI:

```bash
# Sync filesystem components to database
php craft component-manager/components/sync

# Clear cache and re-sync all components
php craft component-manager/components/refresh
```

### Settings

Configure the plugin at **Components → Settings** (accessible via main navigation):

- **Paths** - Set component discovery paths
- **Features** - Enable/disable prop validation, caching, documentation
- **General** - Plugin name, default paths, file extensions
- **Discovery** - Component scanning and ignore patterns
- **Library** - Component library display options
- **Maintenance** - Cache management and cleanup tools

## Performance

### Caching

The plugin includes intelligent caching:

```twig
{# Clear cache programmatically #}
{{ craft.componentManager.clearCache() }}

{# Warm cache #}
{{ craft.componentManager.warmCache() }}

{# Get cache stats #}
{% set stats = craft.componentManager.cacheStats() %}
```

### Best Practices

1. **Use prop validation** to catch errors early
2. **Organize components** in logical folders
3. **Document components** with descriptions and examples
4. **Cache components** in production
5. **Use slots** for flexible layouts
6. **Extend base components** to maintain consistency

## Migration from performing/twig-components

This plugin can work alongside the existing performing/twig-components package during migration:

1. Install Component Manager
2. Configure different tag prefix (e.g., `y` instead of `x`)
3. Gradually migrate components
4. Remove performing/twig-components when complete

## Troubleshooting

### Components not found

- Check component paths in settings
- Ensure files have correct extension (`.twig` by default)
- Clear cache after adding new components

### Prop validation errors

- Check prop definitions in component header
- Ensure required props are provided
- Validate prop types match expected values

### Performance issues

- Enable caching in production
- Use cache warming for frequently used components
- Check component complexity and optimize templates

## Support

- **Documentation**: [https://github.com/LindemannRock/craft-component-manager](https://github.com/LindemannRock/craft-component-manager)
- **Issues**: [https://github.com/LindemannRock/craft-component-manager/issues](https://github.com/LindemannRock/craft-component-manager/issues)
- **Email**: [support@lindemannrock.com](mailto:support@lindemannrock.com)

## License

This plugin is licensed under the MIT License. See [LICENSE](LICENSE) for details.

## Credits

Developed by [LindemannRock](https://lindemannrock.com)

### Special Thanks

This plugin was inspired by and builds upon the excellent work of:

- **[performing/twig-components](https://github.com/performingdigital/twig-components)** - The original Twig components implementation that pioneered the HTML-like syntax for Twig. Special thanks to the Performing Digital team for their innovative approach to component-based templating in Twig. This plugin extends their concept with additional features like folder organization, prop validation, and multiple slots while maintaining the spirit of their original design.

Additional inspiration from:
- Laravel Blade Components - For component architecture patterns
- Vue.js Single File Components - For props validation concepts
- Symfony UX Twig Components - For Twig integration approaches
