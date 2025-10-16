<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\elements;

use lindemannrock\componentmanager\ComponentManager;
use lindemannrock\componentmanager\elements\db\ComponentQuery;
use lindemannrock\componentmanager\records\ComponentRecord;

use Craft;
use craft\base\Element;
use craft\elements\User;
use craft\helpers\UrlHelper;
use craft\elements\conditions\ElementConditionInterface;

/**
 * Component Element
 */
class Component extends Element
{
    // Properties
    // =========================================================================

    public ?string $componentName = null;
    public ?string $path = null;
    public ?string $relativePath = null;
    public ?string $category = null;
    public ?string $description = null;
    public ?array $props = null;
    public ?array $slots = null;
    public ?array $metadata = null;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('component-manager', 'Component');
    }

    /**
     * @inheritdoc
     */
    public static function pluralDisplayName(): string
    {
        return Craft::t('component-manager', 'Components');
    }

    /**
     * @inheritdoc
     */
    public static function hasContent(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%componentmanager_components}}';
    }

    /**
     * @inheritdoc
     */
    public static function hasTitles(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function hasStatuses(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function canView(User $user): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function canSave(User $user): bool
    {
        return false; // Components are read-only
    }

    /**
     * @inheritdoc
     */
    public function canDelete(User $user): bool
    {
        return false; // Components are read-only
    }

    /**
     * @inheritdoc
     */
    public static function find(): ComponentQuery
    {
        return new ComponentQuery(static::class);
    }

    /**
     * @inheritdoc
     */
    protected static function defineSources(string $context = null): array
    {
        $sources = [
            [
                'key' => '*',
                'label' => Craft::t('component-manager', 'All Components'),
                'defaultSort' => ['title', 'asc'],
            ],
        ];

        // Add category sources from database
        $categories = ComponentRecord::find()
            ->select(['category'])
            ->distinct()
            ->where(['not', ['category' => null]])
            ->andWhere(['!=', 'category', ''])
            ->column();
        
        sort($categories);
        
        foreach ($categories as $category) {
            $sources[] = [
                'key' => 'category:' . $category,
                'label' => $category,
                'criteria' => ['category' => $category],
            ];
        }

        return $sources;
    }

    /**
     * @inheritdoc
     */
    protected static function defineActions(string $source = null): array
    {
        // No bulk actions available for read-only components
        return [];
    }

    /**
     * @inheritdoc
     */
    protected static function defineSortOptions(): array
    {
        return [
            'title' => Craft::t('component-manager', 'Component'),
            'componentName' => Craft::t('component-manager', 'Handle'),
            'category' => Craft::t('component-manager', 'Category'),
            'description' => Craft::t('component-manager', 'Description'),
            'path' => Craft::t('component-manager', 'Path'),
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function defineTableAttributes(): array
    {
        return [
            'componentName' => ['label' => Craft::t('component-manager', 'Handle')],
            'description' => ['label' => Craft::t('component-manager', 'Description')],
            'category' => ['label' => Craft::t('component-manager', 'Category')],
            'props' => ['label' => Craft::t('component-manager', 'Props')],
            'slots' => ['label' => Craft::t('component-manager', 'Slots')],
            'path' => ['label' => Craft::t('component-manager', 'Path')],
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function defineDefaultTableAttributes(string $source): array
    {
        // Show Handle, Description, Category, Props, Slots by default (Component column is automatic)
        return ['componentName', 'description', 'category', 'props', 'slots'];
    }

    /**
     * @inheritdoc
     */
    public function getUriFormat(): ?string
    {
        // Disable URI generation to prevent default element behavior
        return null;
    }

    /**
     * @inheritdoc
     */
    protected static function defineSearchableAttributes(): array
    {
        return ['title', 'componentName', 'description', 'category'];
    }

    /**
     * @inheritdoc
     */
    public function getTableAttributeHtml(string $attribute): string
    {
        switch ($attribute) {
            case 'componentName':
                return '<code class="light">' . ($this->componentName ?? '') . '</code>';
                
            case 'description':
                // Check metadata first since that's where the real data is
                $desc = null;
                if ($this->metadata && isset($this->metadata['description'])) {
                    $desc = $this->metadata['description'];
                } else {
                    $desc = $this->description;
                }
                return $desc ?: '<span class="light">—</span>';
                
            case 'category':
                // Check metadata first since that's where the real data is
                $cat = null;
                if ($this->metadata && isset($this->metadata['category'])) {
                    $cat = $this->metadata['category'];
                } else {
                    $cat = $this->category;
                }
                return $cat ?: '<span class="light">—</span>';
                
            case 'props':
                // Count props from metadata if available
                $count = 0;
                if ($this->metadata && isset($this->metadata['props'])) {
                    $count = is_array($this->metadata['props']) ? count($this->metadata['props']) : 0;
                } else if (is_array($this->props)) {
                    $count = count($this->props);
                }
                return $count > 0 ? $count : '<span class="light">—</span>';
                
            case 'slots':
                // Extract slots from JSON like {"0":"icon","3":"endIcon","6":"tooltip"}
                $count = 0;
                if ($this->metadata && isset($this->metadata['slots'])) {
                    // Handle new format with descriptions: {"icon":{"name":"icon","description":"..."}}
                    if (is_array($this->metadata['slots'])) {
                        $count = count($this->metadata['slots']);
                    }
                } else if (is_array($this->slots)) {
                    // Handle old format: ["icon","endIcon","tooltip"] or {"0":"icon","3":"endIcon"}
                    $count = count($this->slots);
                }
                return $count > 0 ? $count : '<span class="light">—</span>';
                
            case 'path':
                return '<code class="light">' . ($this->relativePath ?? $this->path ?? '') . '</code>';
        }

        return parent::getTableAttributeHtml($attribute);
    }

    /**
     * @inheritdoc
     */
    public function getCpEditUrl(): ?string
    {
        return UrlHelper::cpUrl('component-manager/component/' . $this->componentName);
    }

    /**
     * @inheritdoc
     */
    public function getUrl(): ?string
    {
        return $this->getCpEditUrl();
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->getDisplayName();
    }

    /**
     * Get a human-readable display name for the component
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        // If we have a custom title, use it
        if ($this->title && $this->title !== $this->componentName) {
            return $this->title;
        }
        
        // Otherwise, create a nice name from the component name
        $name = $this->componentName ?? '';
        
        // Remove folder prefixes (e.g., "forms/contact-card" becomes "contact-card")
        $parts = explode('/', $name);
        $baseName = end($parts);
        
        // Convert kebab-case to Title Case
        $words = explode('-', $baseName);
        $words = array_map('ucfirst', $words);
        
        return implode(' ', $words);
    }

    /**
     * @inheritdoc
     */
    protected function defineRules(): array
    {
        $rules = parent::defineRules();
        $rules[] = [['componentName'], 'required'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        
        // Force load from database record since joinElementTable might not be working
        if ($this->id) {
            $record = ComponentRecord::findOne($this->id);
            if ($record) {
                $this->componentName = $record->componentName;
                $this->path = $record->path;
                $this->relativePath = $record->relativePath;
                $this->category = $record->category;
                $this->description = $record->description;
                $this->props = $record->props ? json_decode($record->props, true) : null;
                $this->slots = $record->slots ? json_decode($record->slots, true) : null;
                $this->metadata = $record->metadata ? json_decode($record->metadata, true) : null;
                
                // Fallback to metadata if main fields are empty
                if (!$this->description && $this->metadata && isset($this->metadata['description'])) {
                    $this->description = $this->metadata['description'];
                }
                if (!$this->category && $this->metadata && isset($this->metadata['category'])) {
                    $this->category = $this->metadata['category'];
                }
                
                // Set title to display name for Component column
                if ($this->componentName) {
                    $name = $this->componentName;
                    $parts = explode('/', $name);
                    $baseName = end($parts);
                    $words = explode('-', $baseName);
                    $words = array_map('ucfirst', $words);
                    $this->title = implode(' ', $words);
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function afterSave(bool $isNew): void
    {
        if ($isNew) {
            $record = new ComponentRecord();
            $record->id = $this->id;
        } else {
            $record = ComponentRecord::findOne($this->id);
            if (!$record) {
                $record = new ComponentRecord();
                $record->id = $this->id;
            }
        }

        $record->componentName = $this->componentName;
        $record->path = $this->path;
        $record->relativePath = $this->relativePath;
        $record->category = $this->category;
        $record->description = $this->description;
        $record->props = $this->props ? json_encode($this->props) : null;
        $record->slots = $this->slots ? json_encode($this->slots) : null;
        $record->metadata = $this->metadata ? json_encode($this->metadata) : null;

        $record->save(false);

        parent::afterSave($isNew);
    }
}