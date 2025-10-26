<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\models;

use Craft;
use craft\base\Model;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\db\Query;
use craft\helpers\Db;
use craft\helpers\Json;
use lindemannrock\logginglibrary\traits\LoggingTrait;

/**
 * Settings Model
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class Settings extends Model
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
     * @var string The public-facing name of the plugin
     */
    public string $pluginName = 'Component Manager';
    
    /**
     * @var array Component paths relative to templates folder
     */
    public array $componentPaths = [
        '_components',
        'components',
        'src/components',
    ];
    
    /**
     * @var string Default path for new components
     */
    public string $defaultPath = '_components';
    
    /**
     * @var bool Allow nested folder organization
     */
    public bool $allowNesting = true;
    
    /**
     * @var int Maximum nesting depth (0 = unlimited)
     */
    public int $maxNestingDepth = 3;
    
    /**
     * @var bool Cache compiled components
     */
    public bool $enableCache = true;
    
    /**
     * @var int Cache duration in seconds
     */
    public int $cacheDuration = 0;
    
    /**
     * @var string Component tag prefix
     */
    public string $tagPrefix = 'x';
    
    /**
     * @var bool Enable prop validation
     */
    public bool $enablePropValidation = true;
    
    /**
     * @var bool Show helpful error messages
     */
    public bool $enableDebugMode = true;
    
    /**
     * @var bool Allow component inheritance
     */
    public bool $enableInheritance = true;
    
    /**
     * @var bool Enable documentation generation
     */
    public bool $enableDocumentation = true;
    
    /**
     * @var string Component file extension
     */
    public string $componentExtension = 'twig';
    
    /**
     * @var array Folders to ignore
     */
    public array $ignoreFolders = [
        'node_modules',
        '.git',
        'vendor',
        'dist',
        'build',
    ];
    
    /**
     * @var array File patterns to ignore
     */
    public array $ignorePatterns = [
        '*.test.twig',
        '*.spec.twig',
        '_*',
    ];
    
    /**
     * @var bool Enable usage tracking
     */
    public bool $enableUsageTracking = false;
    
    /**
     * @var bool Allow inline components
     */
    public bool $allowInlineComponents = true;
    
    /**
     * @var string Default slot name
     */
    public string $defaultSlotName = 'default';
    
    /**
     * @var bool Enable component library UI
     */
    public bool $enableComponentLibrary = true;
    
    /**
     * @var bool Show component source
     */
    public bool $showComponentSource = true;
    
    /**
     * @var bool Enable live preview
     */
    public bool $enableLivePreview = true;
    
    /**
     * @var array Custom metadata fields
     */
    public array $metadataFields = [
        'description',
        'category',
        'version',
        'author',
        'tags',
    ];

    /**
     * @var string Log level (error, warning, info, debug)
     */
    public string $logLevel = 'error';

    /**
     * @var int Items per page in CP element index
     */
    public int $itemsPerPage = 100;

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'parser' => [
                'class' => EnvAttributeParserBehavior::class,
                'attributes' => ['defaultPath'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['componentPaths', 'defaultPath', 'tagPrefix', 'componentExtension'], 'required'],
            [['componentPaths', 'ignoreFolders', 'ignorePatterns', 'metadataFields'], 'each', 'rule' => ['string']],
            [['defaultPath', 'tagPrefix', 'componentExtension', 'defaultSlotName'], 'string'],
            [['maxNestingDepth', 'cacheDuration'], 'integer', 'min' => 0],
            [['itemsPerPage'], 'integer', 'min' => 10, 'max' => 500],
            [['allowNesting', 'enableCache', 'enablePropValidation', 'enableDebugMode',
              'enableInheritance', 'enableDocumentation', 'enableUsageTracking',
              'allowInlineComponents', 'enableComponentLibrary', 'showComponentSource',
              'enableLivePreview'], 'boolean'],
            [['tagPrefix'], 'match', 'pattern' => '/^[a-zA-Z][a-zA-Z0-9]*$/',
             'message' => 'Tag prefix must start with a letter and contain only letters and numbers.'],
            [['logLevel'], 'in', 'range' => ['debug', 'info', 'warning', 'error']],
            [['logLevel'], 'validateLogLevel'],
        ];
    }

    /**
     * Validate log level - debug requires devMode
     */
    public function validateLogLevel($attribute, $params, $validator)
    {
        $logLevel = $this->$attribute;

        // Reset session warning when devMode is true - allows warning to show again if devMode changes
        if (Craft::$app->getConfig()->getGeneral()->devMode && !Craft::$app->getRequest()->getIsConsoleRequest()) {
            Craft::$app->getSession()->remove('cm_debug_config_warning');
        }

        // Debug level is only allowed when devMode is enabled
        if ($logLevel === 'debug' && !Craft::$app->getConfig()->getGeneral()->devMode) {
            $this->$attribute = 'info';

            if ($this->isOverriddenByConfig('logLevel')) {
                if (!Craft::$app->getRequest()->getIsConsoleRequest()) {
                    if (Craft::$app->getSession()->get('cm_debug_config_warning') === null) {
                        $this->logWarning('Log level "debug" from config file changed to "info" because devMode is disabled', [
                            'configFile' => 'config/component-manager.php'
                        ]);
                        Craft::$app->getSession()->set('cm_debug_config_warning', true);
                    }
                } else {
                    $this->logWarning('Log level "debug" from config file changed to "info" because devMode is disabled', [
                        'configFile' => 'config/component-manager.php'
                    ]);
                }
            } else {
                $this->logWarning('Log level automatically changed from "debug" to "info" because devMode is disabled');
                $this->saveToDatabase();
            }
        }
    }
    
    /**
     * Set component paths from string (for form submission)
     *
     * @param string|array $value
     */
    public function setComponentPaths($value): void
    {
        if (is_string($value)) {
            $this->componentPaths = array_filter(array_map('trim', explode("\n", $value)));
        } else {
            $this->componentPaths = $value;
        }
    }
    
    /**
     * Set ignore patterns from string (for form submission)
     *
     * @param string|array $value
     */
    public function setIgnorePatterns($value): void
    {
        if (is_string($value)) {
            $this->ignorePatterns = array_filter(array_map('trim', explode("\n", $value)));
        } else {
            $this->ignorePatterns = $value;
        }
    }
    
    /**
     * Set ignore folders from string (for form submission)
     *
     * @param string|array $value
     */
    public function setIgnoreFolders($value): void
    {
        if (is_string($value)) {
            $this->ignoreFolders = array_filter(array_map('trim', explode("\n", $value)));
        } else {
            $this->ignoreFolders = $value;
        }
    }
    
    /**
     * Set metadata fields from string (for form submission)
     *
     * @param string|array $value
     */
    public function setMetadataFields($value): void
    {
        if (is_string($value)) {
            $this->metadataFields = array_filter(array_map('trim', explode("\n", $value)));
        } else {
            $this->metadataFields = $value;
        }
    }
    
    /**
     * Load settings from database
     *
     * @param Settings|null $settings Optional existing settings instance
     * @return self
     */
    public static function loadFromDatabase(?Settings $settings = null): self
    {
        if ($settings === null) {
            $settings = new self();
        }

        // Check if table exists first (it won't during initial installation)
        $tableSchema = Craft::$app->getDb()->getTableSchema('{{%componentmanager_settings}}');
        if (!$tableSchema) {
            return $settings;
        }

        $row = (new Query())
            ->select('*')
            ->from('{{%componentmanager_settings}}')
            ->where(['id' => 1])
            ->one();

        if (!$row) {
            return $settings;
        }

        // Remove system fields
        unset($row['id'], $row['dateCreated'], $row['dateUpdated'], $row['uid']);

        // Parse JSON fields
        if (!empty($row['componentPaths'])) {
            $row['componentPaths'] = Json::decodeIfJson($row['componentPaths']);
        }

        if (!empty($row['ignorePatterns'])) {
            $row['ignorePatterns'] = Json::decodeIfJson($row['ignorePatterns']);
        }

        if (!empty($row['ignoreFolders'])) {
            $row['ignoreFolders'] = Json::decodeIfJson($row['ignoreFolders']);
        }

        if (!empty($row['metadataFields'])) {
            $row['metadataFields'] = Json::decodeIfJson($row['metadataFields']);
        }

        // Convert boolean fields
        $booleanFields = ['enablePropValidation', 'enableCache', 'enableDebugMode', 'enableUsageTracking',
                          'allowNesting', 'enableInheritance', 'enableDocumentation', 'allowInlineComponents',
                          'enableComponentLibrary', 'showComponentSource', 'enableLivePreview'];

        foreach ($booleanFields as $field) {
            if (isset($row[$field])) {
                $row[$field] = (bool) $row[$field];
            }
        }

        // Convert integer fields
        $integerFields = ['cacheDuration', 'maxNestingDepth', 'itemsPerPage'];

        foreach ($integerFields as $field) {
            if (isset($row[$field])) {
                $row[$field] = (int) $row[$field];
            }
        }

        // Set attributes from database
        $settings->setAttributes($row, false);

        return $settings;
    }
    
    /**
     * Save settings to database
     *
     * @return bool
     */
    public function saveToDatabase(): bool
    {
        $data = [
            'pluginName' => $this->pluginName,
            'componentPaths' => Json::encode($this->componentPaths),
            'defaultPath' => $this->defaultPath,
            'componentExtension' => $this->componentExtension,
            'enablePropValidation' => $this->enablePropValidation,
            'enableCache' => $this->enableCache,
            'cacheDuration' => $this->cacheDuration,
            'enableDebugMode' => $this->enableDebugMode,
            'enableUsageTracking' => $this->enableUsageTracking,
            'defaultSlotName' => $this->defaultSlotName,
            'ignorePatterns' => Json::encode($this->ignorePatterns),
            'ignoreFolders' => Json::encode($this->ignoreFolders),
            'metadataFields' => Json::encode($this->metadataFields),
            'allowNesting' => $this->allowNesting,
            'maxNestingDepth' => $this->maxNestingDepth,
            'enableInheritance' => $this->enableInheritance,
            'enableDocumentation' => $this->enableDocumentation,
            'allowInlineComponents' => $this->allowInlineComponents,
            'enableComponentLibrary' => $this->enableComponentLibrary,
            'showComponentSource' => $this->showComponentSource,
            'enableLivePreview' => $this->enableLivePreview,
            'logLevel' => $this->logLevel,
            'itemsPerPage' => $this->itemsPerPage,
            'dateUpdated' => Db::prepareDateForDb(new \DateTime()),
        ];
        
        $result = Craft::$app->getDb()->createCommand()
            ->update('{{%componentmanager_settings}}', $data, ['id' => 1])
            ->execute();
            
        return $result > 0;
    }
    
    /**
     * Check if a setting is being overridden by config file
     * Supports dot notation for nested settings like: componentPaths.0
     *
     * @param string $attribute The setting attribute name or dot-notation path
     * @return bool
     */
    public function isOverriddenByConfig(string $attribute): bool
    {
        $configPath = \Craft::$app->getPath()->getConfigPath() . '/component-manager.php';

        if (!file_exists($configPath)) {
            return false;
        }

        // Load the raw config file instead of using Craft's config which merges with database
        $rawConfig = require $configPath;

        // Handle dot notation for nested config
        if (str_contains($attribute, '.')) {
            $parts = explode('.', $attribute);
            $current = $rawConfig;

            foreach ($parts as $part) {
                if (!is_array($current) || !array_key_exists($part, $current)) {
                    return false;
                }
                $current = $current[$part];
            }

            return true;
        }

        // Check for the attribute in the config
        // Use array_key_exists instead of isset to detect null values
        if (array_key_exists($attribute, $rawConfig)) {
            return true;
        }

        // Check environment-specific configs
        $env = \Craft::$app->getConfig()->env;
        if ($env && is_array($rawConfig[$env] ?? null) && array_key_exists($attribute, $rawConfig[$env])) {
            return true;
        }

        // Check wildcard config
        if (is_array($rawConfig['*'] ?? null) && array_key_exists($attribute, $rawConfig['*'])) {
            return true;
        }

        return false;
    }
}