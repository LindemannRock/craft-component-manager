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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organizza componenti, valida props e documenta il design system da un\'unica area di lavoro del pannello di controllo.',
    'Open Component Manager' => 'Apri Component Manager',

    // Navigation
    'Components' => 'Componenti',
    'Documentation' => 'Documentazione',
    'Logs' => 'Log',
    'Settings' => 'Impostazioni',
    'View logs' => 'Visualizza log',
    'View system logs' => 'Visualizza log di sistema',
    'Download system logs' => 'Scarica log di sistema',

    // Common
    'Yes' => 'Sì',
    'No' => 'No',
    'Enabled' => 'Abilitato',
    'Disabled' => 'Disabilitato',
    'Default' => 'Predefinito',
    'Required' => 'Obbligatorio',
    'Example' => 'Esempio',
    'Name' => 'Nome',
    'Type' => 'Tipo',
    'Description' => 'Descrizione',
    'Copy' => 'Copia',
    'Copy Code' => 'Copia codice',
    'Copy Usage' => 'Copia utilizzo',
    'Apply Changes' => 'Applica modifiche',
    'Configure Paths' => 'Configura percorsi',
    'Go to Features Settings' => 'Vai alle impostazioni delle funzionalità',

    // Element
    'Component' => 'Componente',
    'All Components' => 'Tutti i componenti',
    'Handle' => 'Handle',
    'Category' => 'Categoria',
    'Path' => 'Percorso',
    'Props' => 'Props',
    'Slots' => 'Slot',

    // Controller messages
    'Settings saved.' => 'Impostazioni salvate.',
    'Could not save settings.' => 'Impossibile salvare le impostazioni.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'La documentazione dei componenti è disabilitata. Abilitarla nelle impostazioni del plugin.',
    'Component cache cleared successfully.' => 'Cache dei componenti svuotata correttamente.',

    // Settings: General
    'General' => 'Generale',
    'General Settings' => 'Impostazioni generali',
    'Default Slot Name' => 'Nome slot predefinito',
    'Name of the default slot for component content' => 'Nome dello slot predefinito per il contenuto del componente',
    'Logging Settings' => 'Impostazioni di logging',

    // Settings: Discovery
    'Discovery' => 'Rilevamento',
    'Discovery Settings' => 'Impostazioni rilevamento',
    'Allow Nesting' => 'Consenti annidamento',
    'Allow nested folder organization for components' => 'Consenti l\'organizzazione annidata di cartelle per i componenti',
    'Max Nesting Depth' => 'Profondità massima annidamento',
    'Maximum folder nesting depth (0 = unlimited)' => 'Profondità massima di annidamento delle cartelle (0 = illimitato)',
    'Ignore Folders' => 'Ignora cartelle',
    'Folders to ignore when discovering components (one per line)' => 'Cartelle da ignorare durante il rilevamento dei componenti (una per riga)',
    'Ignore Patterns' => 'Ignora modelli',
    'File patterns to ignore when discovering components (one per line)' => 'Modelli di file da ignorare durante il rilevamento dei componenti (uno per riga)',

    // Settings: Features
    'Features' => 'Funzionalità',
    'Enable Prop Validation' => 'Abilita validazione props',
    'Validate component props based on their definitions' => 'Convalida le props dei componenti in base alle loro definizioni',
    'Enable Cache' => 'Abilita cache',
    'Cache component discovery for better performance' => 'Memorizza in cache il rilevamento dei componenti per prestazioni migliori',
    'Cache Duration' => 'Durata cache',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Per quanto tempo memorizzare in cache i dati dei componenti, in secondi (0 = fino allo svuotamento manuale)',
    'Enable Debug Mode' => 'Abilita modalità debug',
    'Show helpful error messages in dev mode' => 'Mostra messaggi di errore utili in modalità sviluppo',
    'Enable Usage Tracking' => 'Abilita monitoraggio utilizzo',
    'Track component usage statistics' => 'Traccia le statistiche di utilizzo dei componenti',
    'Enable Inheritance' => 'Abilita ereditarietà',
    'Allow components to extend other components' => 'Consenti ai componenti di estendere altri componenti',
    'Enable Documentation' => 'Abilita documentazione',
    'Enable automatic documentation generation for components' => 'Abilita la generazione automatica della documentazione per i componenti',
    'Allow Inline Components' => 'Consenti componenti inline',
    'Allow components to be defined inline in templates' => 'Consenti la definizione dei componenti inline nei template',

    // Settings: Paths & Files
    'Paths & Files' => 'Percorsi e file',
    'Component Paths' => 'Percorsi componenti',
    'Paths to search for components (one per line, relative to templates folder)' => 'Percorsi in cui cercare i componenti (uno per riga, relativi alla cartella templates)',
    'Default Path' => 'Percorso predefinito',
    'Default path for components (relative to templates folder)' => 'Percorso predefinito per i componenti (relativo alla cartella templates)',
    'Component Extension' => 'Estensione componente',
    'File extension for component files' => 'Estensione di file per i file dei componenti',

    // Settings: Component Library
    'Component Library' => 'Libreria componenti',
    'Enable Component Library' => 'Abilita libreria componenti',
    'Enable the component library UI in the Control Panel' => 'Abilita l\'interfaccia della libreria componenti nel pannello di controllo',
    'Show Component Source' => 'Mostra codice sorgente componente',
    'Show component source code in the library' => 'Mostra il codice sorgente del componente nella libreria',
    'Enable Live Preview' => 'Abilita anteprima live',
    'Enable live component preview in the library' => 'Abilita l\'anteprima live del componente nella libreria',
    'Metadata Fields' => 'Campi metadati',
    'Custom metadata fields for components (one per line)' => 'Campi metadati personalizzati per i componenti (uno per riga)',

    // Settings: Interface
    'Interface' => 'Interfaccia',
    'Interface Settings' => 'Impostazioni interfaccia',

    // Components: Index
    'Discovered Components' => 'Componenti rilevati',
    'View Documentation' => 'Visualizza documentazione',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Nessun componente trovato. Assicurarsi che i percorsi dei componenti siano configurati correttamente nelle impostazioni.',

    // Components: Detail
    'Live Preview' => 'Anteprima live',
    'Examples' => 'Esempi',
    'Source Code' => 'Codice sorgente',
    'Usage Notes' => 'Note d\'uso',
    'Edit Props' => 'Modifica props',

    // Component Library (Documentation page)
    'Grid View' => 'Vista a griglia',
    'List View' => 'Vista a elenco',
    'Export Docs' => 'Esporta documentazione',
    'Quick Navigation' => 'Navigazione rapida',
    'Preview' => 'Anteprima',
    'Code' => 'Codice',
    'Component Preview' => 'Anteprima componente',
    'No Components Found' => 'Nessun componente trovato',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Non è ancora stato rilevato alcun componente. Assicurarsi che i percorsi dei componenti siano configurati correttamente nelle impostazioni.',

    // Utilities (Maintenance)
    'Maintenance' => 'Manutenzione',
    'Component Cache' => 'Cache componenti',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Svuotare la cache di rilevamento dei componenti per forzare il nuovo rilevamento di tutti i componenti.',
    'Clear Component Cache' => 'Svuota cache componenti',
    'Are you sure you want to clear the component cache?' => 'Svuotare la cache dei componenti?',
    'Cache Duration:' => 'Durata cache:',
    'Until manually cleared' => 'Fino allo svuotamento manuale',
    'seconds' => 'secondi',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'La memorizzazione in cache dei componenti è attualmente disabilitata. Abilitarla nelle impostazioni delle funzionalità.',
    'Usage Statistics' => 'Statistiche utilizzo',
    'Clear component usage statistics and tracking data.' => 'Cancella le statistiche di utilizzo dei componenti e i dati di monitoraggio.',
    'Clear Usage Statistics' => 'Cancella statistiche utilizzo',
    'Are you sure you want to clear all usage statistics?' => 'Cancellare tutte le statistiche di utilizzo?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Il monitoraggio dell\'utilizzo è attualmente disabilitato. Abilitarlo nelle impostazioni delle funzionalità.',
    'Component Discovery' => 'Rilevamento componenti',
    'Force re-discovery of all components from configured paths.' => 'Forza il nuovo rilevamento di tutti i componenti dai percorsi configurati.',
    'Re-discover Components' => 'Rileva nuovamente componenti',
    'Currently searching in:' => 'Ricerca attualmente in:',
    'System Information' => 'Informazioni di sistema',
    'Information about the Component Manager system.' => 'Informazioni sul sistema Component Manager.',
    'Plugin Version' => 'Versione plugin',
    'Schema Version' => 'Versione schema',
    'Components Discovered' => 'Componenti rilevati',
    'components' => 'componenti',
    'Cache Status' => 'Stato cache',
    'Usage Tracking' => 'Monitoraggio utilizzo',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `allowInlineComponents` nel file `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `allowNesting` nel file `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `cacheDuration` nel file `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `componentExtension` nel file `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `componentPaths` nel file `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `defaultPath` nel file `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `defaultSlotName` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableCache` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableComponentLibrary` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableDebugMode` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableDocumentation` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableInheritance` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableLivePreview` nel file `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enablePropValidation` nel file `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `enableUsageTracking` nel file `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `ignoreFolders` nel file `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `ignorePatterns` nel file `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `maxNestingDepth` nel file `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `metadataFields` nel file `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Questa impostazione è sovrascritta dall\'impostazione `showComponentSource` nel file `config/component-manager.php`.',
];
