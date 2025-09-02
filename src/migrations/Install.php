<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * Advanced Twig component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager\migrations;

use craft\db\Migration;
use craft\helpers\Db;
use craft\helpers\Json;
use craft\helpers\StringHelper;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        $this->createTables();
        $this->createIndexes();
        $this->insertDefaultData();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTables();

        return true;
    }

    /**
     * Creates the tables.
     */
    protected function createTables(): void
    {
        // Settings table (single row)
        $this->createTable('{{%twigcomponentmanager_settings}}', [
            'id' => $this->primaryKey(),
            // Plugin settings
            'pluginName' => $this->string()->notNull()->defaultValue('Twig Component Manager'),
            // Component paths (stored as JSON array)
            'componentPaths' => $this->text(),
            // General settings
            'defaultPath' => $this->string()->notNull()->defaultValue('_components'),
            'componentExtension' => $this->string()->notNull()->defaultValue('twig'),
            // Features
            'enablePropValidation' => $this->boolean()->notNull()->defaultValue(true),
            'enableCache' => $this->boolean()->notNull()->defaultValue(true),
            'cacheDuration' => $this->integer()->notNull()->defaultValue(0),
            'enableDebugMode' => $this->boolean()->notNull()->defaultValue(true),
            'enableUsageTracking' => $this->boolean()->notNull()->defaultValue(false),
            'enableInheritance' => $this->boolean()->notNull()->defaultValue(true),
            'enableDocumentation' => $this->boolean()->notNull()->defaultValue(true),
            'allowInlineComponents' => $this->boolean()->notNull()->defaultValue(true),
            // Discovery settings
            'allowNesting' => $this->boolean()->notNull()->defaultValue(true),
            'maxNestingDepth' => $this->integer()->notNull()->defaultValue(3),
            'ignoreFolders' => $this->text(), // JSON array
            'ignorePatterns' => $this->text(), // JSON array
            // Component Library settings
            'enableComponentLibrary' => $this->boolean()->notNull()->defaultValue(true),
            'showComponentSource' => $this->boolean()->notNull()->defaultValue(true),
            'enableLivePreview' => $this->boolean()->notNull()->defaultValue(true),
            'metadataFields' => $this->text(), // JSON array
            // Advanced settings
            'defaultSlotName' => $this->string()->notNull()->defaultValue('default'),
            // System fields
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);

        // Component cache table
        $this->createTable('{{%twigcomponentmanager_cache}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'path' => $this->string()->notNull(),
            'category' => $this->string()->null(),
            'description' => $this->text()->null(),
            'props' => $this->text()->null(), // JSON
            'slots' => $this->text()->null(), // JSON
            'metadata' => $this->text()->null(), // JSON
            'hash' => $this->string(32)->notNull(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);

        // Component usage tracking table
        $this->createTable('{{%twigcomponentmanager_usage}}', [
            'id' => $this->primaryKey(),
            'componentName' => $this->string()->notNull(),
            'template' => $this->string()->null(),
            'siteId' => $this->integer()->null(),
            'count' => $this->integer()->notNull()->defaultValue(1),
            'lastUsed' => $this->dateTime()->notNull(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);

        // Main components table (for Element storage)
        $this->createTable('{{%twigcomponentmanager_components}}', [
            'id' => $this->primaryKey(),
            'componentName' => $this->string()->notNull(),
            'path' => $this->text(),
            'relativePath' => $this->text(),
            'category' => $this->string(),
            'description' => $this->text(),
            'props' => $this->json(),
            'slots' => $this->json(),
            'metadata' => $this->json(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);
    }

    /**
     * Creates the indexes.
     */
    protected function createIndexes(): void
    {
        // Cache indexes
        $this->createIndex(null, '{{%twigcomponentmanager_cache}}', 'name', false);
        $this->createIndex(null, '{{%twigcomponentmanager_cache}}', 'hash', true);
        
        // Usage indexes
        $this->createIndex(null, '{{%twigcomponentmanager_usage}}', 'componentName', false);
        $this->createIndex(null, '{{%twigcomponentmanager_usage}}', ['componentName', 'template', 'siteId'], true);
        
        // Components indexes
        $this->createIndex(null, '{{%twigcomponentmanager_components}}', 'componentName', true);
        $this->createIndex(null, '{{%twigcomponentmanager_components}}', 'category');
    }

    /**
     * Insert default data
     */
    protected function insertDefaultData(): void
    {
        // Insert default settings row
        $this->insert('{{%twigcomponentmanager_settings}}', [
            'id' => 1,
            'pluginName' => 'Twig Component Manager',
            'componentPaths' => Json::encode([
                '_components',
                'components',
                'src/components',
            ]),
            'defaultPath' => '_components',
            'componentExtension' => 'twig',
            'enablePropValidation' => true,
            'enableCache' => true,
            'cacheDuration' => 0,
            'enableDebugMode' => true,
            'enableUsageTracking' => false,
            'enableInheritance' => true,
            'enableDocumentation' => true,
            'allowInlineComponents' => true,
            'allowNesting' => true,
            'maxNestingDepth' => 3,
            'ignoreFolders' => Json::encode([
                'node_modules',
                '.git',
                'vendor',
                'dist',
                'build',
            ]),
            'ignorePatterns' => Json::encode([
                '*.test.twig',
                '*.spec.twig',
                '_*',
            ]),
            'enableComponentLibrary' => true,
            'showComponentSource' => true,
            'enableLivePreview' => true,
            'metadataFields' => Json::encode([
                'description',
                'category',
                'version',
                'author',
                'tags',
            ]),
            'defaultSlotName' => 'default',
            'dateCreated' => Db::prepareDateForDb(new \DateTime()),
            'dateUpdated' => Db::prepareDateForDb(new \DateTime()),
            'uid' => StringHelper::UUID(),
        ]);
    }

    /**
     * Drops the tables.
     */
    protected function dropTables(): void
    {
        $this->dropTableIfExists('{{%twigcomponentmanager_usage}}');
        $this->dropTableIfExists('{{%twigcomponentmanager_cache}}');
        $this->dropTableIfExists('{{%twigcomponentmanager_components}}');
        $this->dropTableIfExists('{{%twigcomponentmanager_settings}}');
    }
}