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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organiser komponenter, valider props og dokumentér dit designsystem fra ét kontrolpanelarbejdsområde.',
    'Open Component Manager' => 'Åbn Component Manager',

    // Navigation
    'Components' => 'Komponenter',
    'Documentation' => 'Dokumentation',
    'Logs' => 'Logge',
    'Settings' => 'Indstillinger',
    'View logs' => 'Vis logge',
    'View system logs' => 'Vis systemlogge',
    'Download system logs' => 'Download systemlogge',

    // Common
    'Yes' => 'Ja',
    'No' => 'Nej',
    'Enabled' => 'Aktiveret',
    'Disabled' => 'Deaktiveret',
    'Default' => 'Standard',
    'Required' => 'Påkrævet',
    'Example' => 'Eksempel',
    'Name' => 'Navn',
    'Type' => 'Type',
    'Description' => 'Beskrivelse',
    'Copy' => 'Kopiér',
    'Copy Code' => 'Kopiér kode',
    'Copy Usage' => 'Kopiér brug',
    'Apply Changes' => 'Anvend ændringer',
    'Configure Paths' => 'Konfigurer stier',
    'Go to Features Settings' => 'Gå til funktionsindstillinger',

    // Element
    'Component' => 'Komponent',
    'All Components' => 'Alle komponenter',
    'Handle' => 'Handle',
    'Category' => 'Kategori',
    'Path' => 'Sti',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Indstillingerne er gemt.',
    'Could not save settings.' => 'Indstillingerne kunne ikke gemmes.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'Komponentdokumentation er deaktiveret. Aktiver den i plugin-indstillingerne.',
    'Component cache cleared successfully.' => 'Komponentcachen er tømt.',

    // Settings: General
    'General' => 'Generelt',
    'General Settings' => 'Generelle indstillinger',
    'Default Slot Name' => 'Standard slot-navn',
    'Name of the default slot for component content' => 'Navnet på standardslotten til komponentindhold',
    'Logging Settings' => 'Logningsindstillinger',

    // Settings: Discovery
    'Discovery' => 'Registrering',
    'Discovery Settings' => 'Registreringsindstillinger',
    'Allow Nesting' => 'Tillad indlejring',
    'Allow nested folder organization for components' => 'Tillad indlejret mappeorganisering for komponenter',
    'Max Nesting Depth' => 'Maksimal indlejringsdybde',
    'Maximum folder nesting depth (0 = unlimited)' => 'Maksimal indlejringsdybde for mapper (0 = ubegrænset)',
    'Ignore Folders' => 'Ignorer mapper',
    'Folders to ignore when discovering components (one per line)' => 'Mapper der skal ignoreres ved registrering af komponenter (én pr. linje)',
    'Ignore Patterns' => 'Ignorer mønstre',
    'File patterns to ignore when discovering components (one per line)' => 'Filmønstre der skal ignoreres ved registrering af komponenter (ét pr. linje)',

    // Settings: Features
    'Features' => 'Funktioner',
    'Enable Prop Validation' => 'Aktiver prop-validering',
    'Validate component props based on their definitions' => 'Valider komponentprops baseret på deres definitioner',
    'Enable Cache' => 'Aktiver cache',
    'Cache component discovery for better performance' => 'Cache komponentregistrering for bedre ydeevne',
    'Cache Duration' => 'Cachevarighed',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Hvor længe komponentdata skal caches, i sekunder (0 = indtil manuelt tømt)',
    'Enable Debug Mode' => 'Aktiver fejlsøgningstilstand',
    'Show helpful error messages in dev mode' => 'Vis nyttige fejlmeddelelser i udviklingstilstand',
    'Enable Usage Tracking' => 'Aktiver brugssporing',
    'Track component usage statistics' => 'Spor statistik for komponentbrug',
    'Enable Inheritance' => 'Aktiver arv',
    'Allow components to extend other components' => 'Tillad komponenter at udvide andre komponenter',
    'Enable Documentation' => 'Aktiver dokumentation',
    'Enable automatic documentation generation for components' => 'Aktiver automatisk dokumentationsgenerering for komponenter',
    'Allow Inline Components' => 'Tillad inline-komponenter',
    'Allow components to be defined inline in templates' => 'Tillad at komponenter defineres inline i skabeloner',

    // Settings: Paths & Files
    'Paths & Files' => 'Stier og filer',
    'Component Paths' => 'Komponentstier',
    'Paths to search for components (one per line, relative to templates folder)' => 'Stier til at søge efter komponenter (én pr. linje, relativ til templates-mappen)',
    'Default Path' => 'Standardsti',
    'Default path for components (relative to templates folder)' => 'Standardsti for komponenter (relativ til templates-mappen)',
    'Component Extension' => 'Komponentudvidelse',
    'File extension for component files' => 'Filtypenavn for komponentfiler',

    // Settings: Component Library
    'Component Library' => 'Komponentbibliotek',
    'Enable Component Library' => 'Aktiver komponentbibliotek',
    'Enable the component library UI in the Control Panel' => 'Aktiver komponentbibliotekets brugerflade i kontrolpanelet',
    'Show Component Source' => 'Vis komponentens kildekode',
    'Show component source code in the library' => 'Vis komponentens kildekode i biblioteket',
    'Enable Live Preview' => 'Aktiver live-forhåndsvisning',
    'Enable live component preview in the library' => 'Aktiver live-forhåndsvisning af komponent i biblioteket',
    'Metadata Fields' => 'Metadatafelter',
    'Custom metadata fields for components (one per line)' => 'Brugerdefinerede metadatafelter for komponenter (ét pr. linje)',

    // Settings: Interface
    'Interface' => 'Brugerflade',
    'Interface Settings' => 'Brugerfladeindstillinger',

    // Components: Index
    'Discovered Components' => 'Registrerede komponenter',
    'View Documentation' => 'Vis dokumentation',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Ingen komponenter fundet. Sørg for, at dine komponentstier er konfigureret korrekt i indstillingerne.',

    // Components: Detail
    'Live Preview' => 'Live-forhåndsvisning',
    'Examples' => 'Eksempler',
    'Source Code' => 'Kildekode',
    'Usage Notes' => 'Brugsnoter',
    'Edit Props' => 'Rediger props',

    // Component Library (Documentation page)
    'Grid View' => 'Gittervisning',
    'List View' => 'Listevisning',
    'Export Docs' => 'Eksporter dokumentation',
    'Quick Navigation' => 'Hurtignavigation',
    'Preview' => 'Forhåndsvisning',
    'Code' => 'Kode',
    'Component Preview' => 'Komponentforhåndsvisning',
    'No Components Found' => 'Ingen komponenter fundet',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Der er endnu ikke registreret nogen komponenter. Sørg for, at dine komponentstier er konfigureret korrekt i indstillingerne.',

    // Utilities (Maintenance)
    'Maintenance' => 'Vedligeholdelse',
    'Component Cache' => 'Komponentcache',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Tøm cachen for komponentregistrering for at fremtvinge en ny registrering af alle komponenter.',
    'Clear Component Cache' => 'Tøm komponentcache',
    'Are you sure you want to clear the component cache?' => 'Er du sikker på, at du vil tømme komponentcachen?',
    'Cache Duration:' => 'Cachevarighed:',
    'Until manually cleared' => 'Indtil manuelt tømt',
    'seconds' => 'sekunder',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'Komponentcachning er i øjeblikket deaktiveret. Aktiver den i funktionsindstillingerne.',
    'Usage Statistics' => 'Brugsstatistik',
    'Clear component usage statistics and tracking data.' => 'Tøm komponentens brugsstatistik og sporingsdata.',
    'Clear Usage Statistics' => 'Tøm brugsstatistik',
    'Are you sure you want to clear all usage statistics?' => 'Er du sikker på, at du vil tømme al brugsstatistik?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Brugssporing er i øjeblikket deaktiveret. Aktiver den i funktionsindstillingerne.',
    'Component Discovery' => 'Komponentregistrering',
    'Force re-discovery of all components from configured paths.' => 'Fremtving ny registrering af alle komponenter fra de konfigurerede stier.',
    'Re-discover Components' => 'Registrer komponenter igen',
    'Currently searching in:' => 'Søger i øjeblikket i:',
    'System Information' => 'Systemoplysninger',
    'Information about the Component Manager system.' => 'Oplysninger om Component Manager-systemet.',
    'Plugin Version' => 'Plugin-version',
    'Schema Version' => 'Skemaversion',
    'Components Discovered' => 'Registrerede komponenter',
    'components' => 'komponenter',
    'Cache Status' => 'Cachestatus',
    'Usage Tracking' => 'Brugssporing',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `allowInlineComponents` i filen `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `allowNesting` i filen `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `cacheDuration` i filen `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `componentExtension` i filen `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `componentPaths` i filen `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `defaultPath` i filen `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `defaultSlotName` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableCache` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableComponentLibrary` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableDebugMode` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableDocumentation` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableInheritance` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableLivePreview` i filen `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enablePropValidation` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `enableUsageTracking` i filen `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `ignoreFolders` i filen `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `ignorePatterns` i filen `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `maxNestingDepth` i filen `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `metadataFields` i filen `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Dette tilsidesættes af indstillingen `showComponentSource` i filen `config/component-manager.php`.',
];
