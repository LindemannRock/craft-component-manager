# Component Manager Logging

Component Manager uses the [LindemannRock Logging Library](https://github.com/LindemannRock/craft-logging-library) for centralized, structured logging across all LindemannRock plugins.

## Log Levels

- **Error**: Critical errors only (default)
- **Warning**: Errors and warnings
- **Info**: General information
- **Debug**: Detailed debugging (includes performance metrics, requires devMode)

## Configuration

### Control Panel

1. Navigate to **Settings → Component Manager → General**
2. Scroll to **Logging Settings**
3. Select desired log level from dropdown
4. Click **Save**

### Config File

```php
// config/component-manager.php
return [
    'pluginName' => 'Components',  // Optional: Customize plugin name shown in logs interface
    'logLevel' => 'error',         // error, warning, info, or debug
];
```

**Notes:**
- The `pluginName` setting customizes how the plugin name appears in the log viewer interface (page title, breadcrumbs, etc.). If not set, it defaults to "Component Manager".
- Debug level requires Craft's `devMode` to be enabled. If set to debug with devMode disabled, it automatically falls back to info level.

## Log Files

- **Location**: `storage/logs/component-manager-YYYY-MM-DD.log`
- **Retention**: 30 days (automatic cleanup via Logging Library)
- **Format**: Structured JSON logs with context data
- **Web Interface**: View and filter logs in CP at Component Manager → Logs

## What's Logged

The plugin logs meaningful events using context arrays for structured data. All logs include user context when available.

### Cache Operations (CacheService)

#### Clear Operations
- **[INFO]** `Component cache cleared` - Cache cleared successfully

#### Warming Operations
- **[WARNING]** `Failed to warm cache for component` - Component cache warming failed
  - Context: `component` (component name), `error` (exception message)
- **[INFO]** `Warmed cache for components` - Cache warming completed
  - Context: `count` (number of components cached)

### Component Operations (ComponentService)

#### Rendering
- **[WARNING]** `Component prop validation failed` - Component prop validation errors detected
  - Context: `component` (component name), `errors` (validation error array)
- **[ERROR]** `Error rendering component` - Component render failure
  - Context: `component` (component name), `error` (exception message)

### Settings Operations (SettingsController)

#### Save Operations
- **[ERROR]** `Settings validation failed` - Settings validation errors
  - Context: `errors` (validation errors array)
- **[INFO]** `Settings saved successfully` - Settings saved to database
- **[ERROR]** `Failed to save settings to database` - Database save failure

### Settings Model (Settings)

#### Log Level Adjustments
- **[WARNING]** `Log level "debug" from config file changed to "info" because devMode is disabled` - Debug level auto-corrected from config file
  - Context: `configFile` (path to config file)
- **[WARNING]** `Log level automatically changed from "debug" to "info" because devMode is disabled` - Debug level auto-corrected from database setting

### Preview Operations (PreviewController)

#### Request Processing
- **[DEBUG]** `Iframe request` - Component preview iframe request received
  - Context: `component` (component name), `variant` (variant name), `propsJson` (props JSON string)
- **[DEBUG]** `Parsed props` - Props parsed from JSON
  - Context: `props` (parsed props array)

#### Variant Resolution
- **[DEBUG]** `Looking for variant in examples` - Searching for variant in component examples
  - Context: `variant` (variant name)
- **[DEBUG]** `Using first example for default` - Using first example as default variant
  - Context: `props` (props array), `content` (default content), `slots` (slots array)
- **[DEBUG]** `Checking example ID` - Checking example ID for variant match
  - Context: `exampleId` (example ID)
- **[DEBUG]** `Found variant` - Variant found in examples
  - Context: `variant` (variant name), `props` (props array), `content` (content string), `slots` (slots array)
- **[DEBUG]** `Final props being used` - Final props after all processing
  - Context: `props` (props array)

### Component Library (ComponentsController)

#### Documentation
- **[DEBUG]** `Contact-card documentation` - Documentation generated for contact-card component (debug-specific logging)
  - Context: `documentation` (full documentation array)

### Documentation Service (DocumentationService)

#### Example Parsing
- **[DEBUG]** `Found JSON examples` - JSON example format detected in component
  - Context: `json` (JSON string)
- **[DEBUG]** `JSON parsed successfully` - JSON examples parsed without errors
  - Context: `decoded` (decoded JSON array)
- **[DEBUG]** `Processing JSON example` - Processing individual JSON example
  - Context: `index` (example index), `example` (example data)
- **[DEBUG]** `Created example` - Example created from JSON
  - Context: `content` (example content), `slots` (example slots)
- **[DEBUG]** `Extracted content` - Content and slots extracted from example
  - Context: `content` (extracted content), `slots` (extracted slots)

## Log Management

### Via Control Panel

1. Navigate to **Component Manager → Logs**
2. Filter by date, level, or search terms
3. Download log files for external analysis
4. View file sizes and entry counts
5. Auto-cleanup after 30 days (configurable via Logging Library)

### Via Command Line

**View today's log**:

```bash
tail -f storage/logs/component-manager-$(date +%Y-%m-%d).log
```

**View specific date**:

```bash
cat storage/logs/component-manager-2025-01-15.log
```

**Search across all logs**:

```bash
grep "Error rendering" storage/logs/component-manager-*.log
```

**Filter by log level**:

```bash
grep "\[ERROR\]" storage/logs/component-manager-*.log
```

## Log Format

Each log entry follows structured JSON format with context data:

```json
{
  "timestamp": "2025-01-15 14:30:45",
  "level": "INFO",
  "message": "Component cache cleared",
  "context": {
    "userId": 1
  },
  "category": "lindemannrock\\componentmanager\\services\\CacheService"
}
```

## Using the Logging Trait

All services and controllers in Component Manager use the `LoggingTrait` from the LindemannRock Logging Library:

```php
use lindemannrock\logginglibrary\traits\LoggingTrait;

class MyService extends Component
{
    use LoggingTrait;

    public function myMethod()
    {
        // Info level - general operations
        $this->logInfo('Operation started', ['param' => $value]);

        // Warning level - important but non-critical
        $this->logWarning('Missing data', ['key' => $missingKey]);

        // Error level - failures and exceptions
        $this->logError('Operation failed', ['error' => $e->getMessage()]);

        // Debug level - detailed information
        $this->logDebug('Processing item', ['item' => $itemData]);
    }
}
```

## Best Practices

### 1. DO NOT Log in init() ⚠️

The `init()` method is called on **every request** (every page load, AJAX call, etc.). Logging there will flood your logs with duplicate entries.

```php
// ❌ BAD - Causes log flooding
public function init(): void
{
    parent::init();
    $this->logInfo('Plugin initialized');  // Called on EVERY request!
}

// ✅ GOOD - Log actual operations
public function renderComponent($name): void
{
    $this->logInfo('Rendering component', ['name' => $name]);
    // ... your logic
}
```

### 2. Always Use Context Arrays

Use the second parameter for variable data, not string concatenation:

```php
// ❌ BAD - Concatenating variables into message
$this->logError('Render failed: ' . $e->getMessage());
$this->logInfo('Processing component: ' . $name);

// ✅ GOOD - Use context array for variables
$this->logError('Render failed', ['error' => $e->getMessage()]);
$this->logInfo('Processing component', ['name' => $name]);
```

**Why Context Arrays Are Better:**
- Structured data for log analysis tools
- Easier to search and filter in log viewer
- Consistent formatting across all logs
- Automatic JSON encoding with UTF-8 support

### 3. Use Appropriate Log Levels

- **debug**: Internal state, variable dumps (requires devMode)
- **info**: Normal operations, user actions
- **warning**: Unexpected but handled situations
- **error**: Actual errors that prevent operation

### 4. Security

- Never log passwords or sensitive data
- Be careful with user input in log messages
- Never log API keys, tokens, or credentials

## Performance Considerations

- **Error/Warning levels**: Minimal performance impact, suitable for production
- **Info level**: Moderate logging, useful for tracking operations
- **Debug level**: Extensive logging, use only in development (requires devMode)
  - Includes detailed component rendering data
  - Logs example processing and variant resolution
  - Tracks documentation generation details
  - Records props and slot data

## Requirements

Component Manager logging requires:

- **lindemannrock/logginglibrary** plugin (installed automatically as dependency)
- Write permissions on `storage/logs` directory
- Craft CMS 5.x or later

## Troubleshooting

If logs aren't appearing:

1. **Check permissions**: Verify `storage/logs` directory is writable
2. **Verify library**: Ensure LindemannRock Logging Library is installed and enabled
3. **Check log level**: Confirm log level allows the messages you're looking for
4. **devMode for debug**: Debug level requires `devMode` enabled in `config/general.php`
5. **Check CP interface**: Use Component Manager → Logs to verify log files exist

## Common Scenarios

### Component Rendering Issues

When components fail to render, check for:

```bash
grep "Error rendering" storage/logs/component-manager-*.log
```

Look for:
- Component not found errors
- Prop validation failures
- Template syntax errors
- Path resolution issues

### Prop Validation Failures

Debug prop validation issues:

```bash
grep "prop validation" storage/logs/component-manager-*.log
```

Common issues:
- Missing required props
- Invalid prop types
- Out-of-range values
- Invalid enum values

### Cache Warming Problems

Track cache warming issues:

```bash
grep "warm cache" storage/logs/component-manager-*.log
```

Review warnings to identify:
- Components that failed to cache
- File read permissions
- Invalid component paths
- Template compilation errors

### Settings Save Failures

Monitor settings save operations:

```bash
grep "Settings" storage/logs/component-manager-*.log
```

Review validation errors to identify:
- Invalid configuration values
- Database connection issues
- Config file overrides preventing saves

### Debug Level Fallback

Monitor log level adjustments:

```bash
grep "Log level" storage/logs/component-manager-*.log
```

**Note**: If you set log level to "debug" without enabling `devMode`, the plugin will automatically adjust to "info" level. Enable `devMode` in `config/general.php` to use debug logging:

```php
// config/general.php
return [
    'dev' => [
        'devMode' => true,
    ],
];
```

## Development Tips

### Enable Debug Logging

For detailed troubleshooting during development:

```php
// config/component-manager.php
return [
    'dev' => [
        'logLevel' => 'debug',
    ],
];
```

This provides:
- Detailed component preview data
- Example parsing details
- Variant resolution steps
- Props and slot data at each stage
- Documentation generation details

### Monitor Specific Operations

Track specific operations using grep:

```bash
# Monitor all cache operations
grep "cache" storage/logs/component-manager-*.log

# Watch component rendering in real-time
tail -f storage/logs/component-manager-$(date +%Y-%m-%d).log | grep "render"

# Check all errors
grep "\[ERROR\]" storage/logs/component-manager-*.log

# Track preview requests
grep "preview\|Iframe\|variant" storage/logs/component-manager-*.log
```

### Debug Component Examples

When troubleshooting component examples in the library:

```bash
# Monitor example parsing
grep "example\|JSON" storage/logs/component-manager-*.log

# Track variant resolution
grep "variant" storage/logs/component-manager-*.log

# Watch props processing
grep "props" storage/logs/component-manager-*.log
```
