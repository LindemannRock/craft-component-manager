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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organiseer componenten, valideer props en documenteer uw designsysteem vanuit één bedieningspaneel-werkruimte.',
    'Open Component Manager' => 'Component Manager openen',

    // Navigation
    'Components' => 'Componenten',
    'Documentation' => 'Documentatie',
    'Logs' => 'Logs',
    'Settings' => 'Instellingen',
    'View logs' => 'Logs weergeven',
    'View system logs' => 'Systeemlogs weergeven',
    'Download system logs' => 'Systeemlogs downloaden',

    // Common
    'Yes' => 'Ja',
    'No' => 'Nee',
    'Enabled' => 'Ingeschakeld',
    'Disabled' => 'Uitgeschakeld',
    'Default' => 'Standaard',
    'Required' => 'Vereist',
    'Example' => 'Voorbeeld',
    'Name' => 'Naam',
    'Type' => 'Type',
    'Description' => 'Beschrijving',
    'Copy' => 'Kopiëren',
    'Copy Code' => 'Code kopiëren',
    'Copy Usage' => 'Gebruik kopiëren',
    'Apply Changes' => 'Wijzigingen toepassen',
    'Configure Paths' => 'Paden configureren',
    'Go to Features Settings' => 'Ga naar functie-instellingen',

    // Element
    'Component' => 'Component',
    'All Components' => 'Alle componenten',
    'Handle' => 'Handle',
    'Category' => 'Categorie',
    'Path' => 'Pad',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Instellingen opgeslagen.',
    'Could not save settings.' => 'Instellingen konden niet worden opgeslagen.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'Componentdocumentatie is uitgeschakeld. Schakel deze in via de plugin-instellingen.',
    'Component cache cleared successfully.' => 'Componentcache is gewist.',

    // Settings: General
    'General' => 'Algemeen',
    'General Settings' => 'Algemene instellingen',
    'Default Slot Name' => 'Standaard slotnaam',
    'Name of the default slot for component content' => 'Naam van de standaardslot voor componentinhoud',
    'Logging Settings' => 'Logging-instellingen',

    // Settings: Discovery
    'Discovery' => 'Detectie',
    'Discovery Settings' => 'Detectie-instellingen',
    'Allow Nesting' => 'Nesting toestaan',
    'Allow nested folder organization for components' => 'Geneste mapindeling voor componenten toestaan',
    'Max Nesting Depth' => 'Maximale nesting-diepte',
    'Maximum folder nesting depth (0 = unlimited)' => 'Maximale nesting-diepte van mappen (0 = onbeperkt)',
    'Ignore Folders' => 'Mappen negeren',
    'Folders to ignore when discovering components (one per line)' => 'Te negeren mappen bij het detecteren van componenten (één per regel)',
    'Ignore Patterns' => 'Patronen negeren',
    'File patterns to ignore when discovering components (one per line)' => 'Te negeren bestandspatronen bij het detecteren van componenten (één per regel)',

    // Settings: Features
    'Features' => 'Functies',
    'Enable Prop Validation' => 'Prop-validatie inschakelen',
    'Validate component props based on their definitions' => 'Componentprops valideren op basis van hun definities',
    'Enable Cache' => 'Cache inschakelen',
    'Cache component discovery for better performance' => 'Componentdetectie cachen voor betere prestaties',
    'Cache Duration' => 'Cacheduur',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Hoe lang componentgegevens worden gecached, in seconden (0 = tot handmatig gewist)',
    'Enable Debug Mode' => 'Debug-modus inschakelen',
    'Show helpful error messages in dev mode' => 'Nuttige foutmeldingen weergeven in dev-modus',
    'Enable Usage Tracking' => 'Gebruiksregistratie inschakelen',
    'Track component usage statistics' => 'Statistieken over componentgebruik bijhouden',
    'Enable Inheritance' => 'Overerving inschakelen',
    'Allow components to extend other components' => 'Componenten toestaan om andere componenten uit te breiden',
    'Enable Documentation' => 'Documentatie inschakelen',
    'Enable automatic documentation generation for components' => 'Automatische documentatiegeneratie voor componenten inschakelen',
    'Allow Inline Components' => 'Inline-componenten toestaan',
    'Allow components to be defined inline in templates' => 'Toestaan dat componenten inline in templates worden gedefinieerd',

    // Settings: Paths & Files
    'Paths & Files' => 'Paden en bestanden',
    'Component Paths' => 'Componentpaden',
    'Paths to search for components (one per line, relative to templates folder)' => 'Paden om componenten te zoeken (één per regel, relatief ten opzichte van de templates-map)',
    'Default Path' => 'Standaardpad',
    'Default path for components (relative to templates folder)' => 'Standaardpad voor componenten (relatief ten opzichte van de templates-map)',
    'Component Extension' => 'Component-extensie',
    'File extension for component files' => 'Bestandsextensie voor componentbestanden',

    // Settings: Component Library
    'Component Library' => 'Componentbibliotheek',
    'Enable Component Library' => 'Componentbibliotheek inschakelen',
    'Enable the component library UI in the Control Panel' => 'De interface van de componentbibliotheek in het bedieningspaneel inschakelen',
    'Show Component Source' => 'Componentbroncode weergeven',
    'Show component source code in the library' => 'Componentbroncode in de bibliotheek weergeven',
    'Enable Live Preview' => 'Live-voorbeeld inschakelen',
    'Enable live component preview in the library' => 'Live-componentvoorbeeld in de bibliotheek inschakelen',
    'Metadata Fields' => 'Metadatavelden',
    'Custom metadata fields for components (one per line)' => 'Aangepaste metadatavelden voor componenten (één per regel)',

    // Settings: Interface
    'Interface' => 'Interface',
    'Interface Settings' => 'Interface-instellingen',

    // Components: Index
    'Discovered Components' => 'Gedetecteerde componenten',
    'View Documentation' => 'Documentatie weergeven',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Geen componenten gevonden. Zorg ervoor dat uw componentpaden correct zijn geconfigureerd in de instellingen.',

    // Components: Detail
    'Live Preview' => 'Live-voorbeeld',
    'Examples' => 'Voorbeelden',
    'Source Code' => 'Broncode',
    'Usage Notes' => 'Gebruiksnotities',
    'Edit Props' => 'Props bewerken',

    // Component Library (Documentation page)
    'Grid View' => 'Rasterweergave',
    'List View' => 'Lijstweergave',
    'Export Docs' => 'Documentatie exporteren',
    'Quick Navigation' => 'Snelle navigatie',
    'Preview' => 'Voorbeeld',
    'Code' => 'Code',
    'Component Preview' => 'Componentvoorbeeld',
    'No Components Found' => 'Geen componenten gevonden',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Er zijn nog geen componenten gedetecteerd. Zorg ervoor dat uw componentpaden correct zijn geconfigureerd in de instellingen.',

    // Utilities (Maintenance)
    'Maintenance' => 'Onderhoud',
    'Component Cache' => 'Componentcache',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Wis de componentdetectiecache om opnieuw detecteren van alle componenten af te dwingen.',
    'Clear Component Cache' => 'Componentcache wissen',
    'Are you sure you want to clear the component cache?' => 'Weet u zeker dat u de componentcache wilt wissen?',
    'Cache Duration:' => 'Cacheduur:',
    'Until manually cleared' => 'Tot handmatig gewist',
    'seconds' => 'seconden',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'Componentcaching is momenteel uitgeschakeld. Schakel het in via de functie-instellingen.',
    'Usage Statistics' => 'Gebruiksstatistieken',
    'Clear component usage statistics and tracking data.' => 'Wis de gebruiksstatistieken en trackinggegevens van componenten.',
    'Clear Usage Statistics' => 'Gebruiksstatistieken wissen',
    'Are you sure you want to clear all usage statistics?' => 'Weet u zeker dat u alle gebruiksstatistieken wilt wissen?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Gebruiksregistratie is momenteel uitgeschakeld. Schakel deze in via de functie-instellingen.',
    'Component Discovery' => 'Componentdetectie',
    'Force re-discovery of all components from configured paths.' => 'Opnieuw detecteren van alle componenten uit de geconfigureerde paden afdwingen.',
    'Re-discover Components' => 'Componenten opnieuw detecteren',
    'Currently searching in:' => 'Wordt momenteel gezocht in:',
    'System Information' => 'Systeeminformatie',
    'Information about the Component Manager system.' => 'Informatie over het Component Manager-systeem.',
    'Plugin Version' => 'Plugin-versie',
    'Schema Version' => 'Schemaversie',
    'Components Discovered' => 'Gedetecteerde componenten',
    'components' => 'componenten',
    'Cache Status' => 'Cachestatus',
    'Usage Tracking' => 'Gebruiksregistratie',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `allowInlineComponents` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `allowNesting` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `cacheDuration` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `componentExtension` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `componentPaths` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `defaultPath` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `defaultSlotName` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableCache` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableComponentLibrary` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableDebugMode` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableDocumentation` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableInheritance` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableLivePreview` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enablePropValidation` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `enableUsageTracking` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `ignoreFolders` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `ignorePatterns` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `maxNestingDepth` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `metadataFields` in het bestand `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Dit wordt overschreven door de instelling `showComponentSource` in het bestand `config/component-manager.php`.',
];
