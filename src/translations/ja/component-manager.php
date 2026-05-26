<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2026 LindemannRock
 */

return [
    // Plugin meta
    'Component Manager' => 'Component Manager',
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'コンポーネントを整理し、プロップスを検証し、デザインシステムを 1 つのコントロールパネルのワークスペースから文書化できます。',
    'Open Component Manager' => 'Component Manager を開く',

    // Navigation
    'Components' => 'コンポーネント',
    'Documentation' => 'ドキュメント',
    'Logs' => 'ログ',
    'Settings' => '設定',
    'View logs' => 'ログを表示',
    'View system logs' => 'システムログを表示',
    'Download system logs' => 'システムログをダウンロード',

    // Common
    'Yes' => 'はい',
    'No' => 'いいえ',
    'Enabled' => '有効',
    'Disabled' => '無効',
    'Default' => 'デフォルト',
    'Required' => '必須',
    'Example' => '例',
    'Name' => '名前',
    'Type' => 'タイプ',
    'Description' => '説明',
    'Copy' => 'コピー',
    'Copy Code' => 'コードをコピー',
    'Copy Usage' => '使用方法をコピー',
    'Apply Changes' => '変更を適用する',
    'Configure Paths' => 'パスを設定する',
    'Go to Features Settings' => '機能設定へ移動',

    // Element
    'Component' => 'コンポーネント',
    'All Components' => 'すべてのコンポーネント',
    'Handle' => 'ハンドル',
    'Category' => 'カテゴリ',
    'Path' => 'パス',
    'Props' => 'プロップス',
    'Slots' => 'スロット',

    // Controller messages
    'Settings saved.' => '設定を保存しました。',
    'Could not save settings.' => '設定を保存できませんでした。',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'コンポーネントドキュメントは無効です。プラグイン設定で有効にしてください。',
    'Component cache cleared successfully.' => 'コンポーネントキャッシュを削除しました。',

    // Settings: General
    'General' => '一般',
    'General Settings' => '一般設定',
    'Default Slot Name' => 'デフォルトのスロット名',
    'Name of the default slot for component content' => 'コンポーネントコンテンツのデフォルトスロット名',
    'Logging Settings' => 'ログ設定',

    // Settings: Discovery
    'Discovery' => '検出',
    'Discovery Settings' => '検出設定',
    'Allow Nesting' => 'ネストを許可する',
    'Allow nested folder organization for components' => 'コンポーネントのネストしたフォルダー構成を許可します',
    'Max Nesting Depth' => '最大ネスト深度',
    'Maximum folder nesting depth (0 = unlimited)' => 'フォルダーの最大ネスト深度 (0 = 無制限)',
    'Ignore Folders' => '無視するフォルダー',
    'Folders to ignore when discovering components (one per line)' => 'コンポーネントを検出する際に無視するフォルダー (1 行に 1 つ)',
    'Ignore Patterns' => '無視するパターン',
    'File patterns to ignore when discovering components (one per line)' => 'コンポーネントを検出する際に無視するファイルパターン (1 行に 1 つ)',

    // Settings: Features
    'Features' => '機能',
    'Enable Prop Validation' => 'プロップス検証を有効にする',
    'Validate component props based on their definitions' => 'コンポーネントのプロップスを定義に基づいて検証します',
    'Enable Cache' => 'キャッシュを有効にする',
    'Cache component discovery for better performance' => 'パフォーマンス向上のためコンポーネント検出をキャッシュします',
    'Cache Duration' => 'キャッシュ期間',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'コンポーネントデータをキャッシュする時間 (秒単位、0 = 手動で削除するまで)',
    'Enable Debug Mode' => 'デバッグモードを有効にする',
    'Show helpful error messages in dev mode' => '開発モードで役立つエラーメッセージを表示します',
    'Enable Usage Tracking' => '使用状況の追跡を有効にする',
    'Track component usage statistics' => 'コンポーネントの使用状況統計を追跡します',
    'Enable Inheritance' => '継承を有効にする',
    'Allow components to extend other components' => 'コンポーネントが他のコンポーネントを拡張できるようにします',
    'Enable Documentation' => 'ドキュメントを有効にする',
    'Enable automatic documentation generation for components' => 'コンポーネントの自動ドキュメント生成を有効にします',
    'Allow Inline Components' => 'インラインコンポーネントを許可する',
    'Allow components to be defined inline in templates' => 'テンプレート内でインラインでのコンポーネント定義を許可します',

    // Settings: Paths & Files
    'Paths & Files' => 'パスとファイル',
    'Component Paths' => 'コンポーネントパス',
    'Paths to search for components (one per line, relative to templates folder)' => 'コンポーネントを検索するパス (1 行に 1 つ、templates フォルダーからの相対パス)',
    'Default Path' => 'デフォルトのパス',
    'Default path for components (relative to templates folder)' => 'コンポーネントのデフォルトパス (templates フォルダーからの相対パス)',
    'Component Extension' => 'コンポーネントの拡張子',
    'File extension for component files' => 'コンポーネントファイルのファイル拡張子',

    // Settings: Component Library
    'Component Library' => 'コンポーネントライブラリ',
    'Enable Component Library' => 'コンポーネントライブラリを有効にする',
    'Enable the component library UI in the Control Panel' => 'コントロールパネルでコンポーネントライブラリ UI を有効にします',
    'Show Component Source' => 'コンポーネントソースを表示する',
    'Show component source code in the library' => 'ライブラリにコンポーネントのソースコードを表示します',
    'Enable Live Preview' => 'ライブプレビューを有効にする',
    'Enable live component preview in the library' => 'ライブラリでコンポーネントのライブプレビューを有効にします',
    'Metadata Fields' => 'メタデータフィールド',
    'Custom metadata fields for components (one per line)' => 'コンポーネントのカスタムメタデータフィールド (1 行に 1 つ)',

    // Settings: Interface
    'Interface' => 'インターフェース',
    'Interface Settings' => 'インターフェース設定',

    // Components: Index
    'Discovered Components' => '検出されたコンポーネント',
    'View Documentation' => 'ドキュメントを表示',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'コンポーネントが見つかりませんでした。設定でコンポーネントパスが正しく設定されていることを確認してください。',

    // Components: Detail
    'Live Preview' => 'ライブプレビュー',
    'Examples' => '例',
    'Source Code' => 'ソースコード',
    'Usage Notes' => '使用上の注意',
    'Edit Props' => 'プロップスを編集',

    // Component Library (Documentation page)
    'Grid View' => 'グリッド表示',
    'List View' => 'リスト表示',
    'Export Docs' => 'ドキュメントをエクスポート',
    'Quick Navigation' => 'クイックナビゲーション',
    'Preview' => 'プレビュー',
    'Code' => 'コード',
    'Component Preview' => 'コンポーネントプレビュー',
    'No Components Found' => 'コンポーネントが見つかりません',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'まだコンポーネントが検出されていません。設定でコンポーネントパスが正しく設定されていることを確認してください。',

    // Utilities (Maintenance)
    'Maintenance' => 'メンテナンス',
    'Component Cache' => 'コンポーネントキャッシュ',
    'Clear the component discovery cache to force re-discovery of all components.' => 'コンポーネント検出キャッシュを削除して、すべてのコンポーネントを強制的に再検出します。',
    'Clear Component Cache' => 'コンポーネントキャッシュを削除',
    'Are you sure you want to clear the component cache?' => 'コンポーネントキャッシュを削除してもよろしいですか？',
    'Cache Duration:' => 'キャッシュ期間:',
    'Until manually cleared' => '手動で削除するまで',
    'seconds' => '秒',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'コンポーネントキャッシュは現在無効です。機能設定で有効にしてください。',
    'Usage Statistics' => '使用状況統計',
    'Clear component usage statistics and tracking data.' => 'コンポーネントの使用状況統計と追跡データを削除します。',
    'Clear Usage Statistics' => '使用状況統計を削除',
    'Are you sure you want to clear all usage statistics?' => 'すべての使用状況統計を削除してもよろしいですか？',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => '使用状況の追跡は現在無効です。機能設定で有効にしてください。',
    'Component Discovery' => 'コンポーネント検出',
    'Force re-discovery of all components from configured paths.' => '設定されたパスからすべてのコンポーネントを強制的に再検出します。',
    'Re-discover Components' => 'コンポーネントを再検出',
    'Currently searching in:' => '現在の検索場所:',
    'System Information' => 'システム情報',
    'Information about the Component Manager system.' => 'Component Manager システムに関する情報です。',
    'Plugin Version' => 'プラグインバージョン',
    'Schema Version' => 'スキーマバージョン',
    'Components Discovered' => '検出されたコンポーネント',
    'components' => 'コンポーネント',
    'Cache Status' => 'キャッシュステータス',
    'Usage Tracking' => '使用状況の追跡',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `allowInlineComponents` 設定によって上書きされています。',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `allowNesting` 設定によって上書きされています。',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `cacheDuration` 設定によって上書きされています。',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `componentExtension` 設定によって上書きされています。',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `componentPaths` 設定によって上書きされています。',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `defaultPath` 設定によって上書きされています。',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `defaultSlotName` 設定によって上書きされています。',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableCache` 設定によって上書きされています。',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableComponentLibrary` 設定によって上書きされています。',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableDebugMode` 設定によって上書きされています。',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableDocumentation` 設定によって上書きされています。',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableInheritance` 設定によって上書きされています。',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableLivePreview` 設定によって上書きされています。',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enablePropValidation` 設定によって上書きされています。',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `enableUsageTracking` 設定によって上書きされています。',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `ignoreFolders` 設定によって上書きされています。',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `ignorePatterns` 設定によって上書きされています。',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `maxNestingDepth` 設定によって上書きされています。',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `metadataFields` 設定によって上書きされています。',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'これは `config/component-manager.php` ファイルの `showComponentSource` 設定によって上書きされています。',
];
