<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2026 LindemannRock
 */

namespace lindemannrock\componentmanager\console\controllers;

use lindemannrock\base\console\controllers\AbstractHelpController;

/**
 * Console help for Component Manager commands.
 *
 * @since 5.7.0
 */
final class HelpController extends AbstractHelpController
{
    /**
     * @inheritdoc
     */
    protected function helpManifest(): array
    {
        return [
            'title' => 'Component Manager',
            'pluginHandle' => 'component-manager',
            'commandPrefixes' => [
                'php craft',
                'ddev craft',
            ],
            'summary' => 'Use these commands to sync filesystem components into the database and refresh cached component discovery data.',
            'common' => [
                'components/sync',
                'components/refresh',
            ],
            'groups' => [
                [
                    'name' => 'components',
                    'label' => 'Components',
                    'description' => 'Sync and refresh discovered component metadata.',
                    'commands' => [
                        [
                            'path' => 'components/sync',
                            'summary' => 'Sync components from filesystem to database.',
                            'description' => 'Scan configured component folders and update the Component Manager database records for created, changed, and deleted components.',
                            'examples' => [
                                'component-manager/components/sync',
                            ],
                            'notes' => [
                                'Use this after adding, deleting, or editing component files outside the Control Panel.',
                            ],
                        ],
                        [
                            'path' => 'components/refresh',
                            'summary' => 'Clear component caches and sync.',
                            'description' => 'Clear discovery and render caches, then run the same filesystem-to-database sync as components/sync.',
                            'examples' => [
                                'component-manager/components/refresh',
                            ],
                            'notes' => [
                                'Use this when component metadata looks stale after filesystem changes.',
                                'Refresh clears caches before syncing, so it is heavier than a normal sync.',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
