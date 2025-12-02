<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\records;

use craft\db\ActiveRecord;

/**
 * Component Record
 *
 * @property int $id
 * @property string $componentName
 * @property string|null $path
 * @property string|null $relativePath
 * @property string|null $category
 * @property string|null $description
 * @property string|null $props
 * @property string|null $slots
 * @property string|null $metadata
 */
class ComponentRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%componentmanager_components}}';
    }
}
