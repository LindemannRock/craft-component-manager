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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Komponenten organisieren, Props validieren und Ihr Designsystem von einem Control-Panel-Arbeitsbereich aus dokumentieren.',
    'Open Component Manager' => 'Component Manager öffnen',

    // Navigation
    'Components' => 'Komponenten',
    'Documentation' => 'Dokumentation',
    'Logs' => 'Protokolle',
    'Settings' => 'Einstellungen',
    'View logs' => 'Protokolle anzeigen',
    'View system logs' => 'Systemprotokolle anzeigen',
    'Download system logs' => 'Systemprotokolle herunterladen',

    // Common
    'Yes' => 'Ja',
    'No' => 'Nein',
    'Enabled' => 'Aktiviert',
    'Disabled' => 'Deaktiviert',
    'Default' => 'Standard',
    'Required' => 'Erforderlich',
    'Example' => 'Beispiel',
    'Name' => 'Name',
    'Type' => 'Typ',
    'Description' => 'Beschreibung',
    'Copy' => 'Kopieren',
    'Copy Code' => 'Code kopieren',
    'Copy Usage' => 'Verwendung kopieren',
    'Apply Changes' => 'Änderungen übernehmen',
    'Configure Paths' => 'Pfade konfigurieren',
    'Go to Features Settings' => 'Zu den Funktions-Einstellungen',

    // Element
    'Component' => 'Komponente',
    'All Components' => 'Alle Komponenten',
    'Handle' => 'Handle',
    'Category' => 'Kategorie',
    'Path' => 'Pfad',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Einstellungen gespeichert.',
    'Could not save settings.' => 'Einstellungen konnten nicht gespeichert werden.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'Die Komponenten-Dokumentation ist deaktiviert. Aktivieren Sie sie in den Plugin-Einstellungen.',
    'Component cache cleared successfully.' => 'Komponenten-Cache erfolgreich geleert.',

    // Settings: General
    'General' => 'Allgemein',
    'General Settings' => 'Allgemeine Einstellungen',
    'Default Slot Name' => 'Standard-Slot-Name',
    'Name of the default slot for component content' => 'Name des Standard-Slots für Komponenten-Inhalt',
    'Logging Settings' => 'Protokoll-Einstellungen',

    // Settings: Discovery
    'Discovery' => 'Erkennung',
    'Discovery Settings' => 'Erkennungs-Einstellungen',
    'Allow Nesting' => 'Verschachtelung erlauben',
    'Allow nested folder organization for components' => 'Verschachtelte Ordnerorganisation für Komponenten erlauben',
    'Max Nesting Depth' => 'Maximale Verschachtelungstiefe',
    'Maximum folder nesting depth (0 = unlimited)' => 'Maximale Ordner-Verschachtelungstiefe (0 = unbegrenzt)',
    'Ignore Folders' => 'Ordner ignorieren',
    'Folders to ignore when discovering components (one per line)' => 'Bei der Komponentenerkennung zu ignorierende Ordner (einer pro Zeile)',
    'Ignore Patterns' => 'Muster ignorieren',
    'File patterns to ignore when discovering components (one per line)' => 'Bei der Komponentenerkennung zu ignorierende Dateimuster (eines pro Zeile)',

    // Settings: Features
    'Features' => 'Funktionen',
    'Enable Prop Validation' => 'Prop-Validierung aktivieren',
    'Validate component props based on their definitions' => 'Komponenten-Props anhand ihrer Definitionen validieren',
    'Enable Cache' => 'Cache aktivieren',
    'Cache component discovery for better performance' => 'Komponentenerkennung für bessere Leistung cachen',
    'Cache Duration' => 'Cache-Dauer',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Wie lange Komponentendaten gecacht werden, in Sekunden (0 = bis manuell geleert)',
    'Enable Debug Mode' => 'Debug-Modus aktivieren',
    'Show helpful error messages in dev mode' => 'Hilfreiche Fehlermeldungen im Dev-Modus anzeigen',
    'Enable Usage Tracking' => 'Nutzungsverfolgung aktivieren',
    'Track component usage statistics' => 'Statistiken zur Komponentennutzung erfassen',
    'Enable Inheritance' => 'Vererbung aktivieren',
    'Allow components to extend other components' => 'Komponenten erlauben, andere Komponenten zu erweitern',
    'Enable Documentation' => 'Dokumentation aktivieren',
    'Enable automatic documentation generation for components' => 'Automatische Dokumentationsgenerierung für Komponenten aktivieren',
    'Allow Inline Components' => 'Inline-Komponenten erlauben',
    'Allow components to be defined inline in templates' => 'Komponenten erlauben, inline in Templates definiert zu werden',

    // Settings: Paths & Files
    'Paths & Files' => 'Pfade & Dateien',
    'Component Paths' => 'Komponenten-Pfade',
    'Paths to search for components (one per line, relative to templates folder)' => 'Pfade für die Komponentensuche (einer pro Zeile, relativ zum Templates-Ordner)',
    'Default Path' => 'Standard-Pfad',
    'Default path for components (relative to templates folder)' => 'Standard-Pfad für Komponenten (relativ zum Templates-Ordner)',
    'Component Extension' => 'Komponenten-Erweiterung',
    'File extension for component files' => 'Dateierweiterung für Komponenten-Dateien',

    // Settings: Component Library
    'Component Library' => 'Komponenten-Bibliothek',
    'Enable Component Library' => 'Komponenten-Bibliothek aktivieren',
    'Enable the component library UI in the Control Panel' => 'Die Komponenten-Bibliothek-Oberfläche im Control Panel aktivieren',
    'Show Component Source' => 'Komponenten-Quellcode anzeigen',
    'Show component source code in the library' => 'Komponenten-Quellcode in der Bibliothek anzeigen',
    'Enable Live Preview' => 'Live-Vorschau aktivieren',
    'Enable live component preview in the library' => 'Live-Komponenten-Vorschau in der Bibliothek aktivieren',
    'Metadata Fields' => 'Metadaten-Felder',
    'Custom metadata fields for components (one per line)' => 'Benutzerdefinierte Metadaten-Felder für Komponenten (eines pro Zeile)',

    // Settings: Interface
    'Interface' => 'Oberfläche',
    'Interface Settings' => 'Oberflächen-Einstellungen',

    // Components: Index
    'Discovered Components' => 'Erkannte Komponenten',
    'View Documentation' => 'Dokumentation anzeigen',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Keine Komponenten gefunden. Stellen Sie sicher, dass Ihre Komponenten-Pfade in den Einstellungen korrekt konfiguriert sind.',

    // Components: Detail
    'Live Preview' => 'Live-Vorschau',
    'Examples' => 'Beispiele',
    'Source Code' => 'Quellcode',
    'Usage Notes' => 'Nutzungshinweise',
    'Edit Props' => 'Props bearbeiten',

    // Component Library (Documentation page)
    'Grid View' => 'Raster-Ansicht',
    'List View' => 'Listen-Ansicht',
    'Export Docs' => 'Dokumentation exportieren',
    'Quick Navigation' => 'Schnellnavigation',
    'Preview' => 'Vorschau',
    'Code' => 'Code',
    'Component Preview' => 'Komponenten-Vorschau',
    'No Components Found' => 'Keine Komponenten gefunden',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Es wurden noch keine Komponenten erkannt. Stellen Sie sicher, dass Ihre Komponenten-Pfade in den Einstellungen korrekt konfiguriert sind.',

    // Utilities (Maintenance)
    'Maintenance' => 'Wartung',
    'Component Cache' => 'Komponenten-Cache',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Den Komponentenerkennungs-Cache leeren, um eine erneute Erkennung aller Komponenten zu erzwingen.',
    'Clear Component Cache' => 'Komponenten-Cache leeren',
    'Are you sure you want to clear the component cache?' => 'Sind Sie sicher, dass Sie den Komponenten-Cache leeren möchten?',
    'Cache Duration:' => 'Cache-Dauer:',
    'Until manually cleared' => 'Bis manuell geleert',
    'seconds' => 'Sekunden',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'Komponenten-Caching ist derzeit deaktiviert. Aktivieren Sie es in den Funktions-Einstellungen.',
    'Usage Statistics' => 'Nutzungsstatistiken',
    'Clear component usage statistics and tracking data.' => 'Komponenten-Nutzungsstatistiken und Tracking-Daten löschen.',
    'Clear Usage Statistics' => 'Nutzungsstatistiken löschen',
    'Are you sure you want to clear all usage statistics?' => 'Sind Sie sicher, dass Sie alle Nutzungsstatistiken löschen möchten?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Nutzungsverfolgung ist derzeit deaktiviert. Aktivieren Sie sie in den Funktions-Einstellungen.',
    'Component Discovery' => 'Komponentenerkennung',
    'Force re-discovery of all components from configured paths.' => 'Erneute Erkennung aller Komponenten aus den konfigurierten Pfaden erzwingen.',
    'Re-discover Components' => 'Komponenten erneut erkennen',
    'Currently searching in:' => 'Wird derzeit gesucht in:',
    'System Information' => 'Systeminformationen',
    'Information about the Component Manager system.' => 'Informationen über das Component Manager-System.',
    'Plugin Version' => 'Plugin-Version',
    'Schema Version' => 'Schema-Version',
    'Components Discovered' => 'Erkannte Komponenten',
    'components' => 'Komponenten',
    'Cache Status' => 'Cache-Status',
    'Usage Tracking' => 'Nutzungsverfolgung',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `allowInlineComponents` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `allowNesting` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `cacheDuration` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `componentExtension` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `componentPaths` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `defaultPath` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `defaultSlotName` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableCache` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableComponentLibrary` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableDebugMode` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableDocumentation` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableInheritance` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableLivePreview` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enablePropValidation` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `enableUsageTracking` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `ignoreFolders` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `ignorePatterns` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `maxNestingDepth` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `metadataFields` in der Datei `config/component-manager.php` überschrieben.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Dies wird durch die Einstellung `showComponentSource` in der Datei `config/component-manager.php` überschrieben.',
];
