<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\elements\db;

use lindemannrock\componentmanager\ComponentManager;
use craft\elements\db\ElementQuery;
use craft\helpers\Db;

/**
 * Component Query
 */
class ComponentQuery extends ElementQuery
{
    public ?string $componentName = null;
    public ?string $category = null;
    public ?string $path = null;

    /**
     * Sets the [[componentName]] property.
     *
     * @param string|null $value
     * @return static self reference
     */
    public function componentName(?string $value): static
    {
        $this->componentName = $value;
        return $this;
    }

    /**
     * Sets the [[category]] property.
     *
     * @param string|null $value
     * @return static self reference
     */
    public function category(?string $value): static
    {
        $this->category = $value;
        return $this;
    }

    /**
     * Sets the [[path]] property.
     *
     * @param string|null $value
     * @return static self reference
     */
    public function path(?string $value): static
    {
        $this->path = $value;
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function beforePrepare(): bool
    {
        // Join with the components table
        $this->joinElementTable('componentmanager_components');

        // Apply component-specific filters
        if ($this->componentName !== null) {
            $this->subQuery->andWhere(Db::parseParam('componentmanager_components.componentName', $this->componentName));
        }

        if ($this->category !== null) {
            $this->subQuery->andWhere(Db::parseParam('componentmanager_components.category', $this->category));
        }

        if ($this->path !== null) {
            $this->subQuery->andWhere(Db::parseParam('componentmanager_components.path', $this->path));
        }

        return parent::beforePrepare();
    }
}