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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organisez les composants, validez les props et documentez votre design system depuis un seul espace de travail du panneau de contrôle.',
    'Open Component Manager' => 'Ouvrir Component Manager',

    // Navigation
    'Components' => 'Composants',
    'Documentation' => 'Documentation',
    'Logs' => 'Journaux',
    'Settings' => 'Paramètres',
    'View logs' => 'Afficher les journaux',
    'View system logs' => 'Afficher les journaux système',
    'Download system logs' => 'Télécharger les journaux système',

    // Common
    'Yes' => 'Oui',
    'No' => 'Non',
    'Enabled' => 'Activé',
    'Disabled' => 'Désactivé',
    'Default' => 'Par défaut',
    'Required' => 'Requis',
    'Example' => 'Exemple',
    'Name' => 'Nom',
    'Type' => 'Type',
    'Description' => 'Description',
    'Copy' => 'Copier',
    'Copy Code' => 'Copier le code',
    'Copy Usage' => 'Copier l\'utilisation',
    'Apply Changes' => 'Appliquer les modifications',
    'Configure Paths' => 'Configurer les chemins',
    'Go to Features Settings' => 'Aller aux paramètres des fonctionnalités',

    // Element
    'Component' => 'Composant',
    'All Components' => 'Tous les composants',
    'Handle' => 'Handle',
    'Category' => 'Catégorie',
    'Path' => 'Chemin',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Paramètres enregistrés.',
    'Could not save settings.' => 'Impossible d\'enregistrer les paramètres.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'La documentation des composants est désactivée. Activez-la dans les paramètres du plugin.',
    'Component cache cleared successfully.' => 'Cache des composants vidé avec succès.',

    // Settings: General
    'General' => 'Général',
    'General Settings' => 'Paramètres généraux',
    'Default Slot Name' => 'Nom du slot par défaut',
    'Name of the default slot for component content' => 'Nom du slot par défaut pour le contenu du composant',
    'Logging Settings' => 'Paramètres de journalisation',

    // Settings: Discovery
    'Discovery' => 'Découverte',
    'Discovery Settings' => 'Paramètres de découverte',
    'Allow Nesting' => 'Autoriser l\'imbrication',
    'Allow nested folder organization for components' => 'Autoriser l\'organisation imbriquée des dossiers pour les composants',
    'Max Nesting Depth' => 'Profondeur maximale d\'imbrication',
    'Maximum folder nesting depth (0 = unlimited)' => 'Profondeur maximale d\'imbrication des dossiers (0 = illimité)',
    'Ignore Folders' => 'Ignorer les dossiers',
    'Folders to ignore when discovering components (one per line)' => 'Dossiers à ignorer lors de la découverte des composants (un par ligne)',
    'Ignore Patterns' => 'Ignorer les motifs',
    'File patterns to ignore when discovering components (one per line)' => 'Motifs de fichiers à ignorer lors de la découverte des composants (un par ligne)',

    // Settings: Features
    'Features' => 'Fonctionnalités',
    'Enable Prop Validation' => 'Activer la validation des props',
    'Validate component props based on their definitions' => 'Valider les props des composants en fonction de leurs définitions',
    'Enable Cache' => 'Activer le cache',
    'Cache component discovery for better performance' => 'Mettre en cache la découverte des composants pour de meilleures performances',
    'Cache Duration' => 'Durée du cache',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Durée de mise en cache des données des composants, en secondes (0 = jusqu\'à effacement manuel)',
    'Enable Debug Mode' => 'Activer le mode de débogage',
    'Show helpful error messages in dev mode' => 'Afficher des messages d\'erreur utiles en mode développement',
    'Enable Usage Tracking' => 'Activer le suivi d\'utilisation',
    'Track component usage statistics' => 'Suivre les statistiques d\'utilisation des composants',
    'Enable Inheritance' => 'Activer l\'héritage',
    'Allow components to extend other components' => 'Autoriser les composants à en étendre d\'autres',
    'Enable Documentation' => 'Activer la documentation',
    'Enable automatic documentation generation for components' => 'Activer la génération automatique de documentation pour les composants',
    'Allow Inline Components' => 'Autoriser les composants en ligne',
    'Allow components to be defined inline in templates' => 'Autoriser la définition de composants en ligne dans les templates',

    // Settings: Paths & Files
    'Paths & Files' => 'Chemins et fichiers',
    'Component Paths' => 'Chemins des composants',
    'Paths to search for components (one per line, relative to templates folder)' => 'Chemins de recherche des composants (un par ligne, relatif au dossier templates)',
    'Default Path' => 'Chemin par défaut',
    'Default path for components (relative to templates folder)' => 'Chemin par défaut pour les composants (relatif au dossier templates)',
    'Component Extension' => 'Extension de composant',
    'File extension for component files' => 'Extension de fichier pour les fichiers de composants',

    // Settings: Component Library
    'Component Library' => 'Bibliothèque de composants',
    'Enable Component Library' => 'Activer la bibliothèque de composants',
    'Enable the component library UI in the Control Panel' => 'Activer l\'interface de la bibliothèque de composants dans le panneau de contrôle',
    'Show Component Source' => 'Afficher le code source des composants',
    'Show component source code in the library' => 'Afficher le code source des composants dans la bibliothèque',
    'Enable Live Preview' => 'Activer l\'aperçu en direct',
    'Enable live component preview in the library' => 'Activer l\'aperçu en direct des composants dans la bibliothèque',
    'Metadata Fields' => 'Champs de métadonnées',
    'Custom metadata fields for components (one per line)' => 'Champs de métadonnées personnalisés pour les composants (un par ligne)',

    // Settings: Interface
    'Interface' => 'Interface',
    'Interface Settings' => 'Paramètres d\'interface',

    // Components: Index
    'Discovered Components' => 'Composants découverts',
    'View Documentation' => 'Afficher la documentation',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Aucun composant trouvé. Assurez-vous que les chemins de vos composants sont correctement configurés dans les paramètres.',

    // Components: Detail
    'Live Preview' => 'Aperçu en direct',
    'Examples' => 'Exemples',
    'Source Code' => 'Code source',
    'Usage Notes' => 'Notes d\'utilisation',
    'Edit Props' => 'Modifier les props',

    // Component Library (Documentation page)
    'Grid View' => 'Vue en grille',
    'List View' => 'Vue en liste',
    'Export Docs' => 'Exporter la documentation',
    'Quick Navigation' => 'Navigation rapide',
    'Preview' => 'Aperçu',
    'Code' => 'Code',
    'Component Preview' => 'Aperçu du composant',
    'No Components Found' => 'Aucun composant trouvé',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Aucun composant n\'a encore été découvert. Assurez-vous que les chemins de vos composants sont correctement configurés dans les paramètres.',

    // Utilities (Maintenance)
    'Maintenance' => 'Maintenance',
    'Component Cache' => 'Cache des composants',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Vider le cache de découverte des composants pour forcer une nouvelle découverte de tous les composants.',
    'Clear Component Cache' => 'Vider le cache des composants',
    'Are you sure you want to clear the component cache?' => 'Êtes-vous sûr de vouloir vider le cache des composants ?',
    'Cache Duration:' => 'Durée du cache :',
    'Until manually cleared' => 'Jusqu\'à effacement manuel',
    'seconds' => 'secondes',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'La mise en cache des composants est actuellement désactivée. Activez-la dans les paramètres des fonctionnalités.',
    'Usage Statistics' => 'Statistiques d\'utilisation',
    'Clear component usage statistics and tracking data.' => 'Effacer les statistiques d\'utilisation des composants et les données de suivi.',
    'Clear Usage Statistics' => 'Effacer les statistiques d\'utilisation',
    'Are you sure you want to clear all usage statistics?' => 'Êtes-vous sûr de vouloir effacer toutes les statistiques d\'utilisation ?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'Le suivi d\'utilisation est actuellement désactivé. Activez-le dans les paramètres des fonctionnalités.',
    'Component Discovery' => 'Découverte des composants',
    'Force re-discovery of all components from configured paths.' => 'Forcer la redécouverte de tous les composants à partir des chemins configurés.',
    'Re-discover Components' => 'Redécouvrir les composants',
    'Currently searching in:' => 'Recherche actuellement dans :',
    'System Information' => 'Informations système',
    'Information about the Component Manager system.' => 'Informations sur le système Component Manager.',
    'Plugin Version' => 'Version du plugin',
    'Schema Version' => 'Version du schéma',
    'Components Discovered' => 'Composants découverts',
    'components' => 'composants',
    'Cache Status' => 'État du cache',
    'Usage Tracking' => 'Suivi d\'utilisation',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `allowInlineComponents` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `allowNesting` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `cacheDuration` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `componentExtension` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `componentPaths` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `defaultPath` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `defaultSlotName` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableCache` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableComponentLibrary` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableDebugMode` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableDocumentation` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableInheritance` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableLivePreview` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enablePropValidation` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `enableUsageTracking` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `ignoreFolders` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `ignorePatterns` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `maxNestingDepth` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `metadataFields` dans le fichier `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Ceci est remplacé par le paramètre `showComponentSource` dans le fichier `config/component-manager.php`.',
];
