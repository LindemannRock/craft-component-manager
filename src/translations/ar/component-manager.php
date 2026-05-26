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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'تنظيم المكونات، والتحقق من Props، وتوثيق نظام التصميم الخاص بك من مساحة عمل واحدة في لوحة التحكم.',
    'Open Component Manager' => 'فتح Component Manager',

    // Navigation
    'Components' => 'المكونات',
    'Documentation' => 'الوثائق',
    'Logs' => 'السجلات',
    'Settings' => 'الإعدادات',
    'View logs' => 'عرض السجلات',
    'View system logs' => 'عرض سجلات النظام',
    'Download system logs' => 'تنزيل سجلات النظام',

    // Common
    'Yes' => 'نعم',
    'No' => 'لا',
    'Enabled' => 'مُفعَّل',
    'Disabled' => 'مُعطَّل',
    'Default' => 'افتراضي',
    'Required' => 'مطلوب',
    'Example' => 'مثال',
    'Name' => 'الاسم',
    'Type' => 'النوع',
    'Description' => 'الوصف',
    'Copy' => 'نسخ',
    'Copy Code' => 'نسخ الكود',
    'Copy Usage' => 'نسخ الاستخدام',
    'Apply Changes' => 'تطبيق التغييرات',
    'Configure Paths' => 'تكوين المسارات',
    'Go to Features Settings' => 'الانتقال إلى إعدادات الميزات',

    // Element
    'Component' => 'المكون',
    'All Components' => 'جميع المكونات',
    'Handle' => 'Handle',
    'Category' => 'الفئة',
    'Path' => 'المسار',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'تم حفظ الإعدادات.',
    'Could not save settings.' => 'تعذر حفظ الإعدادات.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'وثائق المكونات معطّلة. قم بتفعيلها في إعدادات الإضافة.',
    'Component cache cleared successfully.' => 'تم مسح Cache المكونات بنجاح.',

    // Settings: General
    'General' => 'عام',
    'General Settings' => 'الإعدادات العامة',
    'Default Slot Name' => 'اسم Slot الافتراضي',
    'Name of the default slot for component content' => 'اسم Slot الافتراضي لمحتوى المكون',
    'Logging Settings' => 'إعدادات السجل',

    // Settings: Discovery
    'Discovery' => 'الاكتشاف',
    'Discovery Settings' => 'إعدادات الاكتشاف',
    'Allow Nesting' => 'السماح بالتداخل',
    'Allow nested folder organization for components' => 'السماح بتنظيم المجلدات المتداخلة للمكونات',
    'Max Nesting Depth' => 'الحد الأقصى لعمق التداخل',
    'Maximum folder nesting depth (0 = unlimited)' => 'الحد الأقصى لعمق تداخل المجلدات (0 = غير محدود)',
    'Ignore Folders' => 'تجاهل المجلدات',
    'Folders to ignore when discovering components (one per line)' => 'المجلدات التي يتم تجاهلها عند اكتشاف المكونات (واحد في كل سطر)',
    'Ignore Patterns' => 'تجاهل الأنماط',
    'File patterns to ignore when discovering components (one per line)' => 'أنماط الملفات التي يتم تجاهلها عند اكتشاف المكونات (واحد في كل سطر)',

    // Settings: Features
    'Features' => 'الميزات',
    'Enable Prop Validation' => 'تفعيل التحقق من Props',
    'Validate component props based on their definitions' => 'التحقق من Props المكون بناءً على تعريفاتها',
    'Enable Cache' => 'تفعيل Cache',
    'Cache component discovery for better performance' => 'تخزين اكتشاف المكونات في Cache لتحسين الأداء',
    'Cache Duration' => 'مدة Cache',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'مدة تخزين بيانات المكون في Cache بالثواني (0 = حتى المسح اليدوي)',
    'Enable Debug Mode' => 'تفعيل وضع التصحيح',
    'Show helpful error messages in dev mode' => 'عرض رسائل خطأ مفيدة في وضع التطوير',
    'Enable Usage Tracking' => 'تفعيل تتبع الاستخدام',
    'Track component usage statistics' => 'تتبع إحصائيات استخدام المكونات',
    'Enable Inheritance' => 'تفعيل الوراثة',
    'Allow components to extend other components' => 'السماح للمكونات بتوسيع مكونات أخرى',
    'Enable Documentation' => 'تفعيل الوثائق',
    'Enable automatic documentation generation for components' => 'تفعيل التوليد التلقائي للوثائق للمكونات',
    'Allow Inline Components' => 'السماح بالمكونات المضمّنة',
    'Allow components to be defined inline in templates' => 'السماح بتعريف المكونات بشكل مضمّن داخل القوالب',

    // Settings: Paths & Files
    'Paths & Files' => 'المسارات والملفات',
    'Component Paths' => 'مسارات المكونات',
    'Paths to search for components (one per line, relative to templates folder)' => 'مسارات البحث عن المكونات (واحد في كل سطر، نسبيًا لمجلد templates)',
    'Default Path' => 'المسار الافتراضي',
    'Default path for components (relative to templates folder)' => 'المسار الافتراضي للمكونات (نسبيًا لمجلد templates)',
    'Component Extension' => 'امتداد المكون',
    'File extension for component files' => 'امتداد الملف لملفات المكونات',

    // Settings: Component Library
    'Component Library' => 'مكتبة المكونات',
    'Enable Component Library' => 'تفعيل مكتبة المكونات',
    'Enable the component library UI in the Control Panel' => 'تفعيل واجهة مكتبة المكونات في لوحة التحكم',
    'Show Component Source' => 'عرض مصدر المكون',
    'Show component source code in the library' => 'عرض الكود المصدري للمكون في المكتبة',
    'Enable Live Preview' => 'تفعيل المعاينة المباشرة',
    'Enable live component preview in the library' => 'تفعيل المعاينة المباشرة للمكون في المكتبة',
    'Metadata Fields' => 'حقول البيانات الوصفية',
    'Custom metadata fields for components (one per line)' => 'حقول بيانات وصفية مخصصة للمكونات (واحد في كل سطر)',

    // Settings: Interface
    'Interface' => 'الواجهة',
    'Interface Settings' => 'إعدادات الواجهة',

    // Components: Index
    'Discovered Components' => 'المكونات المكتشفة',
    'View Documentation' => 'عرض الوثائق',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'لم يتم العثور على مكونات. تأكد من أن مسارات المكونات الخاصة بك مُهيَّأة بشكل صحيح في الإعدادات.',

    // Components: Detail
    'Live Preview' => 'المعاينة المباشرة',
    'Examples' => 'الأمثلة',
    'Source Code' => 'الكود المصدري',
    'Usage Notes' => 'ملاحظات الاستخدام',
    'Edit Props' => 'تحرير Props',

    // Component Library (Documentation page)
    'Grid View' => 'عرض الشبكة',
    'List View' => 'عرض القائمة',
    'Export Docs' => 'تصدير الوثائق',
    'Quick Navigation' => 'التنقل السريع',
    'Preview' => 'المعاينة',
    'Code' => 'الكود',
    'Component Preview' => 'معاينة المكون',
    'No Components Found' => 'لم يتم العثور على مكونات',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'لم يتم اكتشاف أي مكونات بعد. تأكد من أن مسارات المكونات الخاصة بك مُهيَّأة بشكل صحيح في الإعدادات.',

    // Utilities (Maintenance)
    'Maintenance' => 'الصيانة',
    'Component Cache' => 'Cache المكونات',
    'Clear the component discovery cache to force re-discovery of all components.' => 'مسح Cache اكتشاف المكونات لإجبار إعادة اكتشاف جميع المكونات.',
    'Clear Component Cache' => 'مسح Cache المكونات',
    'Are you sure you want to clear the component cache?' => 'هل أنت متأكد من أنك تريد مسح Cache المكونات؟',
    'Cache Duration:' => 'مدة Cache:',
    'Until manually cleared' => 'حتى المسح اليدوي',
    'seconds' => 'ثوانٍ',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'تخزين المكونات في Cache معطّل حاليًا. قم بتفعيله في إعدادات الميزات.',
    'Usage Statistics' => 'إحصائيات الاستخدام',
    'Clear component usage statistics and tracking data.' => 'مسح إحصائيات استخدام المكونات وبيانات التتبع.',
    'Clear Usage Statistics' => 'مسح إحصائيات الاستخدام',
    'Are you sure you want to clear all usage statistics?' => 'هل أنت متأكد من أنك تريد مسح جميع إحصائيات الاستخدام؟',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'تتبع الاستخدام معطّل حاليًا. قم بتفعيله في إعدادات الميزات.',
    'Component Discovery' => 'اكتشاف المكونات',
    'Force re-discovery of all components from configured paths.' => 'إجبار إعادة اكتشاف جميع المكونات من المسارات المُهيَّأة.',
    'Re-discover Components' => 'إعادة اكتشاف المكونات',
    'Currently searching in:' => 'البحث حاليًا في:',
    'System Information' => 'معلومات النظام',
    'Information about the Component Manager system.' => 'معلومات حول نظام Component Manager.',
    'Plugin Version' => 'إصدار الإضافة',
    'Schema Version' => 'إصدار المخطط',
    'Components Discovered' => 'المكونات المكتشفة',
    'components' => 'مكونات',
    'Cache Status' => 'حالة Cache',
    'Usage Tracking' => 'تتبع الاستخدام',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `allowInlineComponents` في ملف `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `allowNesting` في ملف `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `cacheDuration` في ملف `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `componentExtension` في ملف `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `componentPaths` في ملف `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `defaultPath` في ملف `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `defaultSlotName` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableCache` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableComponentLibrary` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableDebugMode` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableDocumentation` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableInheritance` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableLivePreview` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enablePropValidation` في ملف `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `enableUsageTracking` في ملف `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `ignoreFolders` في ملف `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `ignorePatterns` في ملف `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `maxNestingDepth` في ملف `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `metadataFields` في ملف `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'يتم تجاوز هذا بواسطة الإعداد `showComponentSource` في ملف `config/component-manager.php`.',
];
