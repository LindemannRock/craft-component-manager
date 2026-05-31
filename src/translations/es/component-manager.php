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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organice componentes, valide props y documente su sistema de diseño desde un único espacio de trabajo del panel de control.',
    'Open Component Manager' => 'Abrir Component Manager',

    // Navigation
    'Components' => 'Componentes',
    'Documentation' => 'Documentación',
    'Logs' => 'Registros',
    'Settings' => 'Configuración',
    'View logs' => 'Ver registros',
    'View system logs' => 'Ver registros del sistema',
    'Download system logs' => 'Descargar registros del sistema',

    // Common
    'Yes' => 'Sí',
    'No' => 'No',
    'Enabled' => 'Activado',
    'Disabled' => 'Desactivado',
    'Default' => 'Predeterminado',
    'Required' => 'Obligatorio',
    'Example' => 'Ejemplo',
    'Name' => 'Nombre',
    'Type' => 'Tipo',
    'Description' => 'Descripción',
    'Copy' => 'Copiar',
    'Copy Code' => 'Copiar código',
    'Copy Usage' => 'Copiar uso',
    'Apply Changes' => 'Aplicar cambios',
    'Configure Paths' => 'Configurar rutas',
    'Go to Features Settings' => 'Ir a la configuración de funciones',

    // Element
    'Component' => 'Componente',
    'All Components' => 'Todos los componentes',
    'Handle' => 'Handle',
    'Category' => 'Categoría',
    'Path' => 'Ruta',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Configuración guardada.',
    'Could not save settings.' => 'No se pudo guardar la configuración.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'La documentación de componentes está desactivada. Actívela en la configuración del plugin.',
    'Component cache cleared successfully.' => 'Caché de componentes vaciada correctamente.',
    'Component not found' => 'Componente no encontrado',

    // Settings: General
    'General' => 'General',
    'General Settings' => 'Configuración general',
    'Default Slot Name' => 'Nombre de slot predeterminado',
    'Name of the default slot for component content' => 'Nombre del slot predeterminado para el contenido del componente',
    'Logging Settings' => 'Configuración de registro',

    // Settings: Discovery
    'Discovery' => 'Detección',
    'Discovery Settings' => 'Configuración de detección',
    'Allow Nesting' => 'Permitir anidamiento',
    'Allow nested folder organization for components' => 'Permitir la organización anidada de carpetas para componentes',
    'Max Nesting Depth' => 'Profundidad máxima de anidamiento',
    'Maximum folder nesting depth (0 = unlimited)' => 'Profundidad máxima de anidamiento de carpetas (0 = ilimitado)',
    'Ignore Folders' => 'Ignorar carpetas',
    'Folders to ignore when discovering components (one per line)' => 'Carpetas a ignorar al detectar componentes (una por línea)',
    'Ignore Patterns' => 'Ignorar patrones',
    'File patterns to ignore when discovering components (one per line)' => 'Patrones de archivo a ignorar al detectar componentes (uno por línea)',

    // Settings: Features
    'Features' => 'Funciones',
    'Enable Prop Validation' => 'Activar validación de props',
    'Validate component props based on their definitions' => 'Validar props de componentes según sus definiciones',
    'Enable Cache' => 'Activar caché',
    'Cache component discovery for better performance' => 'Almacenar en caché la detección de componentes para un mejor rendimiento',
    'Cache Duration' => 'Duración de la caché',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Cuánto tiempo almacenar en caché los datos de componentes, en segundos (0 = hasta vaciar manualmente)',
    'Enable Debug Mode' => 'Activar modo de depuración',
    'Show helpful error messages in dev mode' => 'Mostrar mensajes de error útiles en modo de desarrollo',
    'Enable Usage Tracking' => 'Activar seguimiento de uso',
    'Track component usage statistics' => 'Registrar estadísticas de uso de componentes',
    'Enable Inheritance' => 'Activar herencia',
    'Allow components to extend other components' => 'Permitir que los componentes extiendan otros componentes',
    'Enable Documentation' => 'Activar documentación',
    'Enable automatic documentation generation for components' => 'Activar la generación automática de documentación para componentes',
    'Allow Inline Components' => 'Permitir componentes en línea',
    'Allow components to be defined inline in templates' => 'Permitir que los componentes se definan en línea en las plantillas',

    // Settings: Paths & Files
    'Paths & Files' => 'Rutas y archivos',
    'Component Paths' => 'Rutas de componentes',
    'Paths to search for components (one per line, relative to templates folder)' => 'Rutas en las que buscar componentes (una por línea, relativa a la carpeta templates)',
    'Default Path' => 'Ruta predeterminada',
    'Default path for components (relative to templates folder)' => 'Ruta predeterminada para componentes (relativa a la carpeta templates)',
    'Component Extension' => 'Extensión de componente',
    'File extension for component files' => 'Extensión de archivo para los archivos de componentes',

    // Settings: Component Library
    'Component Library' => 'Biblioteca de componentes',
    'Enable Component Library' => 'Activar biblioteca de componentes',
    'Enable the component library UI in the Control Panel' => 'Activar la interfaz de la biblioteca de componentes en el panel de control',
    'Show Component Source' => 'Mostrar código fuente del componente',
    'Show component source code in the library' => 'Mostrar el código fuente del componente en la biblioteca',
    'Enable Live Preview' => 'Activar vista previa en vivo',
    'Enable live component preview in the library' => 'Activar la vista previa en vivo del componente en la biblioteca',
    'Metadata Fields' => 'Campos de metadatos',
    'Custom metadata fields for components (one per line)' => 'Campos de metadatos personalizados para componentes (uno por línea)',

    // Settings: Interface
    'Interface' => 'Interfaz',
    'Interface Settings' => 'Configuración de interfaz',

    // Components: Index
    'Discovered Components' => 'Componentes detectados',
    'View Documentation' => 'Ver documentación',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'No se encontraron componentes. Asegúrese de que las rutas de componentes estén configuradas correctamente en la configuración.',

    // Components: Detail
    'Live Preview' => 'Vista previa en vivo',
    'Examples' => 'Ejemplos',
    'Source Code' => 'Código fuente',
    'Usage Notes' => 'Notas de uso',
    'Edit Props' => 'Editar props',

    // Component Library (Documentation page)
    'Grid View' => 'Vista de cuadrícula',
    'List View' => 'Vista de lista',
    'Export Docs' => 'Exportar documentación',
    'Quick Navigation' => 'Navegación rápida',
    'Preview' => 'Vista previa',
    'Code' => 'Código',
    'Component Preview' => 'Vista previa del componente',
    'No Components Found' => 'No se encontraron componentes',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Aún no se han detectado componentes. Asegúrese de que las rutas de componentes estén configuradas correctamente en la configuración.',

    // Utilities (Maintenance)
    'Maintenance' => 'Mantenimiento',
    'Component Cache' => 'Caché de componentes',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Vacíe la caché de detección de componentes para forzar una nueva detección de todos los componentes.',
    'Clear Component Cache' => 'Vaciar caché de componentes',
    'Are you sure you want to clear the component cache?' => '¿Está seguro de que desea vaciar la caché de componentes?',
    'Cache Duration:' => 'Duración de la caché:',
    'Until manually cleared' => 'Hasta vaciar manualmente',
    'seconds' => 'segundos',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'El almacenamiento en caché de componentes está actualmente desactivado. Actívelo en la configuración de funciones.',
    'Usage Statistics' => 'Estadísticas de uso',
    'Clear component usage statistics and tracking data.' => 'Borre las estadísticas de uso de componentes y los datos de seguimiento.',
    'Clear Usage Statistics' => 'Borrar estadísticas de uso',
    'Are you sure you want to clear all usage statistics?' => '¿Está seguro de que desea borrar todas las estadísticas de uso?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'El seguimiento de uso está actualmente desactivado. Actívelo en la configuración de funciones.',
    'Component Discovery' => 'Detección de componentes',
    'Force re-discovery of all components from configured paths.' => 'Forzar la nueva detección de todos los componentes desde las rutas configuradas.',
    'Re-discover Components' => 'Volver a detectar componentes',
    'Currently searching in:' => 'Buscando actualmente en:',
    'System Information' => 'Información del sistema',
    'Information about the Component Manager system.' => 'Información sobre el sistema Component Manager.',
    'Plugin Version' => 'Versión del plugin',
    'Schema Version' => 'Versión del esquema',
    'Components Discovered' => 'Componentes detectados',
    'components' => 'componentes',
    'Cache Status' => 'Estado de la caché',
    'Usage Tracking' => 'Seguimiento de uso',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `allowInlineComponents` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `allowNesting` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `cacheDuration` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `componentExtension` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `componentPaths` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `defaultPath` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `defaultSlotName` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableCache` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableComponentLibrary` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableDebugMode` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableDocumentation` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableInheritance` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableLivePreview` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enablePropValidation` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `enableUsageTracking` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `ignoreFolders` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `ignorePatterns` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `maxNestingDepth` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `metadataFields` en el archivo `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Esto está siendo anulado por la configuración `showComponentSource` en el archivo `config/component-manager.php`.',
];
