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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organisera komponenter, validera props och dokumentera ditt designsystem från en och samma kontrollpanelarbetsyta.',
    'Open Component Manager' => 'Öppna Component Manager',

    // Navigation
    'Components' => 'Komponenter',
    'Documentation' => 'Dokumentation',
    'Logs' => 'Loggar',
    'Settings' => 'Inställningar',
    'View logs' => 'Visa loggar',
    'View system logs' => 'Visa systemloggar',
    'Download system logs' => 'Ladda ner systemloggar',

    // Common
    'Yes' => 'Ja',
    'No' => 'Nej',
    'Enabled' => 'Aktiverad',
    'Disabled' => 'Inaktiverad',
    'Default' => 'Standard',
    'Required' => 'Obligatorisk',
    'Example' => 'Exempel',
    'Name' => 'Namn',
    'Type' => 'Typ',
    'Description' => 'Beskrivning',
    'Copy' => 'Kopiera',
    'Copy Code' => 'Kopiera kod',
    'Copy Usage' => 'Kopiera användning',
    'Apply Changes' => 'Tillämpa ändringar',
    'Configure Paths' => 'Konfigurera sökvägar',
    'Go to Features Settings' => 'Gå till funktionsinställningar',

    // Element
    'Component' => 'Komponent',
    'All Components' => 'Alla komponenter',
    'Handle' => 'Handle',
    'Category' => 'Kategori',
    'Path' => 'Sökväg',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Inställningarna sparades.',
    'Could not save settings.' => 'Det gick inte att spara inställningarna.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'Komponentdokumentation är inaktiverad. Aktivera den i pluginets inställningar.',
    'Component cache cleared successfully.' => 'Komponentcachen tömdes.',

    // Settings: General
    'General' => 'Allmänt',
    'General Settings' => 'Allmänna inställningar',
    'Default Slot Name' => 'Standardnamn för slot',
    'Name of the default slot for component content' => 'Namn på standardslot för komponentinnehåll',
    'Logging Settings' => 'Logginställningar',

    // Settings: Discovery
    'Discovery' => 'Identifiering',
    'Discovery Settings' => 'Identifieringsinställningar',
    'Allow Nesting' => 'Tillåt kapsling',
    'Allow nested folder organization for components' => 'Tillåt kapslad mapporganisation för komponenter',
    'Max Nesting Depth' => 'Maximalt kapslingsdjup',
    'Maximum folder nesting depth (0 = unlimited)' => 'Maximalt kapslingsdjup för mappar (0 = obegränsat)',
    'Ignore Folders' => 'Ignorera mappar',
    'Folders to ignore when discovering components (one per line)' => 'Mappar att ignorera vid identifiering av komponenter (en per rad)',
    'Ignore Patterns' => 'Ignorera mönster',
    'File patterns to ignore when discovering components (one per line)' => 'Filmönster att ignorera vid identifiering av komponenter (ett per rad)',

    // Settings: Features
    'Features' => 'Funktioner',
    'Enable Prop Validation' => 'Aktivera prop-validering',
    'Validate component props based on their definitions' => 'Validera komponentprops baserat på deras definitioner',
    'Enable Cache' => 'Aktivera cache',
    'Cache component discovery for better performance' => 'Cacha komponentidentifiering för bättre prestanda',
    'Cache Duration' => 'Cachetid',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Hur länge komponentdata ska cachas, i sekunder (0 = tills manuellt tömd)',
    'Enable Debug Mode' => 'Aktivera felsökningsläge',
    'Show helpful error messages in dev mode' => 'Visa hjälpsamma felmeddelanden i utvecklingsläge',
    'Enable Usage Tracking' => 'Aktivera användningsspårning',
    'Track component usage statistics' => 'Spåra statistik för komponentanvändning',
    'Enable Inheritance' => 'Aktivera arv',
    'Allow components to extend other components' => 'Tillåt komponenter att utöka andra komponenter',
    'Enable Documentation' => 'Aktivera dokumentation',
    'Enable automatic documentation generation for components' => 'Aktivera automatisk dokumentationsgenerering för komponenter',
    'Allow Inline Components' => 'Tillåt inline-komponenter',
    'Allow components to be defined inline in templates' => 'Tillåt att komponenter definieras inline i mallar',

    // Settings: Paths & Files
    'Paths & Files' => 'Sökvägar och filer',
    'Component Paths' => 'Komponentsökvägar',
    'Paths to search for components (one per line, relative to templates folder)' => 'Sökvägar att söka efter komponenter i (en per rad, relativt mappen templates)',
    'Default Path' => 'Standardsökväg',
    'Default path for components (relative to templates folder)' => 'Standardsökväg för komponenter (relativt mappen templates)',
    'Component Extension' => 'Komponenttillägg',
    'File extension for component files' => 'Filändelse för komponentfiler',

    // Settings: Component Library
    'Component Library' => 'Komponentbibliotek',
    'Enable Component Library' => 'Aktivera komponentbibliotek',
    'Enable the component library UI in the Control Panel' => 'Aktivera komponentbibliotekets gränssnitt i kontrollpanelen',
    'Show Component Source' => 'Visa komponentkällkod',
    'Show component source code in the library' => 'Visa komponentens källkod i biblioteket',
    'Enable Live Preview' => 'Aktivera direktförhandsgranskning',
    'Enable live component preview in the library' => 'Aktivera direktförhandsgranskning av komponenter i biblioteket',
    'Metadata Fields' => 'Metadatafält',
    'Custom metadata fields for components (one per line)' => 'Anpassade metadatafält för komponenter (ett per rad)',

    // Settings: Interface
    'Interface' => 'Gränssnitt',
    'Interface Settings' => 'Gränssnittsinställningar',

    // Components: Index
    'Discovered Components' => 'Identifierade komponenter',
    'View Documentation' => 'Visa dokumentation',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Inga komponenter hittades. Kontrollera att dina komponentsökvägar är korrekt konfigurerade i inställningarna.',

    // Components: Detail
    'Live Preview' => 'Direktförhandsgranskning',
    'Examples' => 'Exempel',
    'Source Code' => 'Källkod',
    'Usage Notes' => 'Användningsanteckningar',
    'Edit Props' => 'Redigera props',

    // Component Library (Documentation page)
    'Grid View' => 'Rutnätsvy',
    'List View' => 'Listvy',
    'Export Docs' => 'Exportera dokumentation',
    'Quick Navigation' => 'Snabbnavigering',
    'Preview' => 'Förhandsgranska',
    'Code' => 'Kod',
    'Component Preview' => 'Komponentförhandsgranskning',
    'No Components Found' => 'Inga komponenter hittades',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Inga komponenter har identifierats ännu. Kontrollera att dina komponentsökvägar är korrekt konfigurerade i inställningarna.',

    // Utilities (Maintenance)
    'Maintenance' => 'Underhåll',
    'Component Cache' => 'Komponentcache',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Töm cachen för komponentidentifiering för att tvinga fram en ny identifiering av alla komponenter.',
    'Clear Component Cache' => 'Töm komponentcache',
    'Are you sure you want to clear the component cache?' => 'Är du säker på att du vill tömma komponentcachen?',
    'Cache Duration:' => 'Cachetid:',
    'Until manually cleared' => 'Tills manuellt tömd',
    'seconds' => 'sekunder',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'Komponentcachning är för närvarande inaktiverad. Aktivera den i funktionsinställningarna.',
    'Usage Statistics' => 'Användningsstatistik',
    'Clear component usage statistics and tracking data.' => 'Töm statistiken för komponentanvändning och spårningsdata.',
    'Clear Usage Statistics' => 'Töm användningsstatistik',
    'Are you sure you want to clear all usage statistics?' => 'Är du säker på att du vill tömma all användningsstatistik?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Användningsspårning är för närvarande inaktiverad. Aktivera den i funktionsinställningarna.',
    'Component Discovery' => 'Komponentidentifiering',
    'Force re-discovery of all components from configured paths.' => 'Tvinga fram en ny identifiering av alla komponenter från konfigurerade sökvägar.',
    'Re-discover Components' => 'Identifiera komponenter igen',
    'Currently searching in:' => 'Söker just nu i:',
    'System Information' => 'Systeminformation',
    'Information about the Component Manager system.' => 'Information om Component Manager-systemet.',
    'Plugin Version' => 'Pluginversion',
    'Schema Version' => 'Schemaversion',
    'Components Discovered' => 'Identifierade komponenter',
    'components' => 'komponenter',
    'Cache Status' => 'Cachestatus',
    'Usage Tracking' => 'Användningsspårning',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `allowInlineComponents` i filen `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `allowNesting` i filen `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `cacheDuration` i filen `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `componentExtension` i filen `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `componentPaths` i filen `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `defaultPath` i filen `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `defaultSlotName` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableCache` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableComponentLibrary` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableDebugMode` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableDocumentation` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableInheritance` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableLivePreview` i filen `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enablePropValidation` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `enableUsageTracking` i filen `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `ignoreFolders` i filen `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `ignorePatterns` i filen `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `maxNestingDepth` i filen `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `metadataFields` i filen `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Detta åsidosätts av inställningen `showComponentSource` i filen `config/component-manager.php`.',
];
