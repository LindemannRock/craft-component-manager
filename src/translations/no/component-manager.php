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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organiser komponenter, valider props og dokumenter designsystemet ditt fra ett kontrollpanel-arbeidsområde.',
    'Open Component Manager' => 'Åpne Component Manager',

    // Navigation
    'Components' => 'Komponenter',
    'Documentation' => 'Dokumentasjon',
    'Logs' => 'Logger',
    'Settings' => 'Innstillinger',
    'View logs' => 'Vis logger',
    'View system logs' => 'Vis systemlogger',
    'Download system logs' => 'Last ned systemlogger',

    // Common
    'Yes' => 'Ja',
    'No' => 'Nei',
    'Enabled' => 'Aktivert',
    'Disabled' => 'Deaktivert',
    'Default' => 'Standard',
    'Required' => 'Påkrevd',
    'Example' => 'Eksempel',
    'Name' => 'Navn',
    'Type' => 'Type',
    'Description' => 'Beskrivelse',
    'Copy' => 'Kopier',
    'Copy Code' => 'Kopier kode',
    'Copy Usage' => 'Kopier bruk',
    'Apply Changes' => 'Bruk endringer',
    'Configure Paths' => 'Konfigurer stier',
    'Go to Features Settings' => 'Gå til funksjonsinnstillinger',

    // Element
    'Component' => 'Komponent',
    'All Components' => 'Alle komponenter',
    'Handle' => 'Handle',
    'Category' => 'Kategori',
    'Path' => 'Sti',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Innstillingene er lagret.',
    'Could not save settings.' => 'Kunne ikke lagre innstillingene.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'Komponentdokumentasjon er deaktivert. Aktiver den i plugin-innstillingene.',
    'Component cache cleared successfully.' => 'Komponent-cachen er tømt.',

    // Settings: General
    'General' => 'Generelt',
    'General Settings' => 'Generelle innstillinger',
    'Default Slot Name' => 'Standard slot-navn',
    'Name of the default slot for component content' => 'Navnet på standardslotten for komponentinnhold',
    'Logging Settings' => 'Logginnstillinger',

    // Settings: Discovery
    'Discovery' => 'Oppdagelse',
    'Discovery Settings' => 'Oppdagelsesinnstillinger',
    'Allow Nesting' => 'Tillat nesting',
    'Allow nested folder organization for components' => 'Tillat nestet mappeorganisering for komponenter',
    'Max Nesting Depth' => 'Maksimal nesting-dybde',
    'Maximum folder nesting depth (0 = unlimited)' => 'Maksimal nesting-dybde for mapper (0 = ubegrenset)',
    'Ignore Folders' => 'Ignorer mapper',
    'Folders to ignore when discovering components (one per line)' => 'Mapper som skal ignoreres ved oppdagelse av komponenter (én per linje)',
    'Ignore Patterns' => 'Ignorer mønstre',
    'File patterns to ignore when discovering components (one per line)' => 'Filmønstre som skal ignoreres ved oppdagelse av komponenter (ett per linje)',

    // Settings: Features
    'Features' => 'Funksjoner',
    'Enable Prop Validation' => 'Aktiver prop-validering',
    'Validate component props based on their definitions' => 'Valider komponentprops basert på deres definisjoner',
    'Enable Cache' => 'Aktiver cache',
    'Cache component discovery for better performance' => 'Cache komponentoppdagelse for bedre ytelse',
    'Cache Duration' => 'Cache-varighet',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Hvor lenge komponentdata skal caches, i sekunder (0 = inntil manuelt tømt)',
    'Enable Debug Mode' => 'Aktiver feilsøkingsmodus',
    'Show helpful error messages in dev mode' => 'Vis nyttige feilmeldinger i utviklingsmodus',
    'Enable Usage Tracking' => 'Aktiver bruksporing',
    'Track component usage statistics' => 'Spor statistikk for komponentbruk',
    'Enable Inheritance' => 'Aktiver arv',
    'Allow components to extend other components' => 'Tillat komponenter å utvide andre komponenter',
    'Enable Documentation' => 'Aktiver dokumentasjon',
    'Enable automatic documentation generation for components' => 'Aktiver automatisk dokumentasjonsgenerering for komponenter',
    'Allow Inline Components' => 'Tillat inline-komponenter',
    'Allow components to be defined inline in templates' => 'Tillat at komponenter defineres inline i maler',

    // Settings: Paths & Files
    'Paths & Files' => 'Stier og filer',
    'Component Paths' => 'Komponentstier',
    'Paths to search for components (one per line, relative to templates folder)' => 'Stier å søke etter komponenter i (én per linje, relativ til templates-mappen)',
    'Default Path' => 'Standardsti',
    'Default path for components (relative to templates folder)' => 'Standardsti for komponenter (relativ til templates-mappen)',
    'Component Extension' => 'Komponentutvidelse',
    'File extension for component files' => 'Filendelse for komponentfiler',

    // Settings: Component Library
    'Component Library' => 'Komponentbibliotek',
    'Enable Component Library' => 'Aktiver komponentbibliotek',
    'Enable the component library UI in the Control Panel' => 'Aktiver komponentbibliotekets grensesnitt i kontrollpanelet',
    'Show Component Source' => 'Vis komponentens kildekode',
    'Show component source code in the library' => 'Vis komponentens kildekode i biblioteket',
    'Enable Live Preview' => 'Aktiver live-forhåndsvisning',
    'Enable live component preview in the library' => 'Aktiver live-forhåndsvisning av komponent i biblioteket',
    'Metadata Fields' => 'Metadata-felter',
    'Custom metadata fields for components (one per line)' => 'Tilpassede metadata-felter for komponenter (ett per linje)',

    // Settings: Interface
    'Interface' => 'Grensesnitt',
    'Interface Settings' => 'Grensesnittinnstillinger',

    // Components: Index
    'Discovered Components' => 'Oppdagede komponenter',
    'View Documentation' => 'Vis dokumentasjon',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Ingen komponenter funnet. Sørg for at komponentstiene dine er konfigurert riktig i innstillingene.',

    // Components: Detail
    'Live Preview' => 'Live-forhåndsvisning',
    'Examples' => 'Eksempler',
    'Source Code' => 'Kildekode',
    'Usage Notes' => 'Bruksnotater',
    'Edit Props' => 'Rediger props',

    // Component Library (Documentation page)
    'Grid View' => 'Rutenettvisning',
    'List View' => 'Listevisning',
    'Export Docs' => 'Eksporter dokumentasjon',
    'Quick Navigation' => 'Hurtignavigering',
    'Preview' => 'Forhåndsvisning',
    'Code' => 'Kode',
    'Component Preview' => 'Komponentforhåndsvisning',
    'No Components Found' => 'Ingen komponenter funnet',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Ingen komponenter er oppdaget ennå. Sørg for at komponentstiene dine er konfigurert riktig i innstillingene.',

    // Utilities (Maintenance)
    'Maintenance' => 'Vedlikehold',
    'Component Cache' => 'Komponent-cache',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Tøm cachen for komponentoppdagelse for å tvinge frem ny oppdagelse av alle komponenter.',
    'Clear Component Cache' => 'Tøm komponent-cache',
    'Are you sure you want to clear the component cache?' => 'Er du sikker på at du vil tømme komponent-cachen?',
    'Cache Duration:' => 'Cache-varighet:',
    'Until manually cleared' => 'Inntil manuelt tømt',
    'seconds' => 'sekunder',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'Komponent-caching er for øyeblikket deaktivert. Aktiver den i funksjonsinnstillingene.',
    'Usage Statistics' => 'Bruksstatistikk',
    'Clear component usage statistics and tracking data.' => 'Tøm bruksstatistikken og sporingsdataene for komponenter.',
    'Clear Usage Statistics' => 'Tøm bruksstatistikk',
    'Are you sure you want to clear all usage statistics?' => 'Er du sikker på at du vil tømme all bruksstatistikk?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Bruksporing er for øyeblikket deaktivert. Aktiver den i funksjonsinnstillingene.',
    'Component Discovery' => 'Komponentoppdagelse',
    'Force re-discovery of all components from configured paths.' => 'Tving frem ny oppdagelse av alle komponenter fra de konfigurerte stiene.',
    'Re-discover Components' => 'Oppdag komponenter på nytt',
    'Currently searching in:' => 'Søker for øyeblikket i:',
    'System Information' => 'Systeminformasjon',
    'Information about the Component Manager system.' => 'Informasjon om Component Manager-systemet.',
    'Plugin Version' => 'Plugin-versjon',
    'Schema Version' => 'Skjemaversjon',
    'Components Discovered' => 'Oppdagede komponenter',
    'components' => 'komponenter',
    'Cache Status' => 'Cache-status',
    'Usage Tracking' => 'Bruksporing',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `allowInlineComponents` i filen `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `allowNesting` i filen `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `cacheDuration` i filen `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `componentExtension` i filen `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `componentPaths` i filen `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `defaultPath` i filen `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `defaultSlotName` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableCache` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableComponentLibrary` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableDebugMode` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableDocumentation` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableInheritance` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableLivePreview` i filen `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enablePropValidation` i filen `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `enableUsageTracking` i filen `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `ignoreFolders` i filen `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `ignorePatterns` i filen `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `maxNestingDepth` i filen `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `metadataFields` i filen `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Dette overstyres av innstillingen `showComponentSource` i filen `config/component-manager.php`.',
];
