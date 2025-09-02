<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * Advanced Twig component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager\models;

use Craft;
use craft\base\Model;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\db\Query;
use craft\helpers\Db;
use craft\helpers\Json;

/**
 * Settings Model
 *
 * @author    LindemannRock
 * @package   TwigComponentManager
 * @since     1.0.0
 */
class Settings extends Model
{
    /**
     * @var string The public-facing name of the plugin
     */
    public string $pluginName = 'Twig Component Manager';
    
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
            [['allowNesting', 'enableCache', 'enablePropValidation', 'enableDebugMode', 
              'enableInheritance', 'enableDocumentation', 'enableUsageTracking',
              'allowInlineComponents', 'enableComponentLibrary', 'showComponentSource',
              'enableLivePreview'], 'boolean'],
            [['tagPrefix'], 'match', 'pattern' => '/^[a-zA-Z][a-zA-Z0-9]*$/', 
             'message' => 'Tag prefix must start with a letter and contain only letters and numbers.'],
        ];
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
     * @return bool
     */
    public function loadFromDb(): bool
    {
        $settings = (new Query())
            ->select('*')
            ->from('{{%twigcomponentmanager_settings}}')
            ->where(['id' => 1])
            ->one();
            
        if (!$settings) {
            return false;
        }
        
        // Parse JSON fields
        if (!empty($settings['componentPaths'])) {
            $this->componentPaths = Json::decodeIfJson($settings['componentPaths']);
        }
        
        if (!empty($settings['ignorePatterns'])) {
            $this->ignorePatterns = Json::decodeIfJson($settings['ignorePatterns']);
        }
        
        if (!empty($settings['ignoreFolders'])) {
            $this->ignoreFolders = Json::decodeIfJson($settings['ignoreFolders']);
        }
        
        if (!empty($settings['metadataFields'])) {
            $this->metadataFields = Json::decodeIfJson($settings['metadataFields']);
        }
        
        // Set other fields
        $this->pluginName = $settings['pluginName'] ?? $this->pluginName;
        $this->defaultPath = $settings['defaultPath'] ?? $this->defaultPath;
        $this->componentExtension = $settings['componentExtension'] ?? $this->componentExtension;
        $this->enablePropValidation = (bool)($settings['enablePropValidation'] ?? $this->enablePropValidation);
        $this->enableCache = (bool)($settings['enableCache'] ?? $this->enableCache);
        $this->cacheDuration = (int)($settings['cacheDuration'] ?? $this->cacheDuration);
        $this->enableDebugMode = (bool)($settings['enableDebugMode'] ?? $this->enableDebugMode);
        $this->enableUsageTracking = (bool)($settings['enableUsageTracking'] ?? $this->enableUsageTracking);
        $this->defaultSlotName = $settings['defaultSlotName'] ?? $this->defaultSlotName;
        $this->allowNesting = (bool)($settings['allowNesting'] ?? $this->allowNesting);
        $this->maxNestingDepth = (int)($settings['maxNestingDepth'] ?? $this->maxNestingDepth);
        $this->enableInheritance = (bool)($settings['enableInheritance'] ?? $this->enableInheritance);
        $this->enableDocumentation = (bool)($settings['enableDocumentation'] ?? $this->enableDocumentation);
        $this->allowInlineComponents = (bool)($settings['allowInlineComponents'] ?? $this->allowInlineComponents);
        $this->enableComponentLibrary = (bool)($settings['enableComponentLibrary'] ?? $this->enableComponentLibrary);
        $this->showComponentSource = (bool)($settings['showComponentSource'] ?? $this->showComponentSource);
        $this->enableLivePreview = (bool)($settings['enableLivePreview'] ?? $this->enableLivePreview);
        
        return true;
    }
    
    /**
     * Save settings to database
     *
     * @return bool
     */
    public function saveToDb(): bool
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
            'dateUpdated' => Db::prepareDateForDb(new \DateTime()),
        ];
        
        $result = Craft::$app->getDb()->createCommand()
            ->update('{{%twigcomponentmanager_settings}}', $data, ['id' => 1])
            ->execute();
            
        return $result > 0;
    }
    
    /**
     * Check if a setting is overridden by config file
     *
     * @param string $setting
     * @return bool
     */
    public function isOverridden(string $setting): bool
    {
        $configFileSettings = Craft::$app->getConfig()->getConfigFromFile('twig-component-manager');
        return isset($configFileSettings[$setting]);
    }
}