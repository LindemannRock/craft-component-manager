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
use lindemannrock\base\traits\SettingsConfigTrait;
use lindemannrock\base\traits\SettingsDisplayNameTrait;
use lindemannrock\base\traits\SettingsPersistenceTrait;
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
    use SettingsConfigTrait;
    use SettingsDisplayNameTrait;
    use SettingsPersistenceTrait;

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
              'enableLivePreview', ], 'boolean'],
            [['tagPrefix'], 'match', 'pattern' => '/^[a-zA-Z][a-zA-Z0-9]*$/',
             'message' => 'Tag prefix must start with a letter and contain only letters and numbers.', ],
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
                            'configFile' => 'config/component-manager.php',
                        ]);
                        Craft::$app->getSession()->set('cm_debug_config_warning', true);
                    }
                } else {
                    $this->logWarning('Log level "debug" from config file changed to "info" because devMode is disabled', [
                        'configFile' => 'config/component-manager.php',
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
    
    // =========================================================================
    // Trait Configuration Methods
    // =========================================================================

    /**
     * Database table name for settings storage
     */
    protected static function tableName(): string
    {
        return 'componentmanager_settings';
    }

    /**
     * Plugin handle for config file resolution
     */
    protected static function pluginHandle(): string
    {
        return 'component-manager';
    }

    /**
     * Fields that should be cast to boolean
     */
    protected static function booleanFields(): array
    {
        return [
            'allowNesting',
            'enableCache',
            'enablePropValidation',
            'enableDebugMode',
            'enableInheritance',
            'enableDocumentation',
            'enableUsageTracking',
            'allowInlineComponents',
            'enableComponentLibrary',
            'showComponentSource',
            'enableLivePreview',
        ];
    }

    /**
     * Fields that should be cast to integer
     */
    protected static function integerFields(): array
    {
        return [
            'maxNestingDepth',
            'cacheDuration',
            'itemsPerPage',
        ];
    }

    /**
     * Fields that should be JSON encoded/decoded
     */
    protected static function jsonFields(): array
    {
        return [
            'componentPaths',
            'ignoreFolders',
            'ignorePatterns',
            'metadataFields',
        ];
    }

    /**
     * Fields to exclude from database save
     */
    protected static function excludeFromSave(): array
    {
        return ['tagPrefix'];
    }
}
