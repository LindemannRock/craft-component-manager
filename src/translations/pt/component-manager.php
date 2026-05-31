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
    'Organize components, validate props, and document your design system from one control panel workspace.' => 'Organize componentes, valide props e documente o seu design system a partir de um único espaço de trabalho do painel de controlo.',
    'Open Component Manager' => 'Abrir Component Manager',

    // Navigation
    'Components' => 'Componentes',
    'Documentation' => 'Documentação',
    'Logs' => 'Registos',
    'Settings' => 'Definições',
    'View logs' => 'Ver registos',
    'View system logs' => 'Ver registos do sistema',
    'Download system logs' => 'Descarregar registos do sistema',

    // Common
    'Yes' => 'Sim',
    'No' => 'Não',
    'Enabled' => 'Ativado',
    'Disabled' => 'Desativado',
    'Default' => 'Predefinido',
    'Required' => 'Obrigatório',
    'Example' => 'Exemplo',
    'Name' => 'Nome',
    'Type' => 'Tipo',
    'Description' => 'Descrição',
    'Copy' => 'Copiar',
    'Copy Code' => 'Copiar código',
    'Copy Usage' => 'Copiar utilização',
    'Apply Changes' => 'Aplicar alterações',
    'Configure Paths' => 'Configurar caminhos',
    'Go to Features Settings' => 'Ir para as definições de funcionalidades',

    // Element
    'Component' => 'Componente',
    'All Components' => 'Todos os componentes',
    'Handle' => 'Handle',
    'Category' => 'Categoria',
    'Path' => 'Caminho',
    'Props' => 'Props',
    'Slots' => 'Slots',

    // Controller messages
    'Settings saved.' => 'Definições guardadas.',
    'Could not save settings.' => 'Não foi possível guardar as definições.',
    'Component documentation is disabled. Enable it in the plugin settings.' => 'A documentação de componentes está desativada. Ative-a nas definições do plugin.',
    'Component cache cleared successfully.' => 'Cache de componentes esvaziada com sucesso.',

    // Settings: General
    'General' => 'Geral',
    'General Settings' => 'Definições gerais',
    'Default Slot Name' => 'Nome de slot predefinido',
    'Name of the default slot for component content' => 'Nome do slot predefinido para o conteúdo do componente',
    'Logging Settings' => 'Definições de registo',

    // Settings: Discovery
    'Discovery' => 'Deteção',
    'Discovery Settings' => 'Definições de deteção',
    'Allow Nesting' => 'Permitir aninhamento',
    'Allow nested folder organization for components' => 'Permitir a organização aninhada de pastas para componentes',
    'Max Nesting Depth' => 'Profundidade máxima de aninhamento',
    'Maximum folder nesting depth (0 = unlimited)' => 'Profundidade máxima de aninhamento de pastas (0 = ilimitado)',
    'Ignore Folders' => 'Ignorar pastas',
    'Folders to ignore when discovering components (one per line)' => 'Pastas a ignorar ao detetar componentes (uma por linha)',
    'Ignore Patterns' => 'Ignorar padrões',
    'File patterns to ignore when discovering components (one per line)' => 'Padrões de ficheiros a ignorar ao detetar componentes (um por linha)',

    // Settings: Features
    'Features' => 'Funcionalidades',
    'Enable Prop Validation' => 'Ativar validação de props',
    'Validate component props based on their definitions' => 'Validar props de componentes com base nas suas definições',
    'Enable Cache' => 'Ativar cache',
    'Cache component discovery for better performance' => 'Colocar a deteção de componentes em cache para melhor desempenho',
    'Cache Duration' => 'Duração da cache',
    'How long to cache component data, in seconds (0 = until manually cleared)' => 'Durante quanto tempo manter os dados de componentes em cache, em segundos (0 = até esvaziar manualmente)',
    'Enable Debug Mode' => 'Ativar modo de depuração',
    'Show helpful error messages in dev mode' => 'Mostrar mensagens de erro úteis em modo de desenvolvimento',
    'Enable Usage Tracking' => 'Ativar monitorização de utilização',
    'Track component usage statistics' => 'Registar estatísticas de utilização de componentes',
    'Enable Inheritance' => 'Ativar herança',
    'Allow components to extend other components' => 'Permitir que os componentes estendam outros componentes',
    'Enable Documentation' => 'Ativar documentação',
    'Enable automatic documentation generation for components' => 'Ativar a geração automática de documentação para componentes',
    'Allow Inline Components' => 'Permitir componentes inline',
    'Allow components to be defined inline in templates' => 'Permitir que os componentes sejam definidos inline nos templates',

    // Settings: Paths & Files
    'Paths & Files' => 'Caminhos e ficheiros',
    'Component Paths' => 'Caminhos de componentes',
    'Paths to search for components (one per line, relative to templates folder)' => 'Caminhos onde procurar componentes (um por linha, relativo à pasta templates)',
    'Default Path' => 'Caminho predefinido',
    'Default path for components (relative to templates folder)' => 'Caminho predefinido para componentes (relativo à pasta templates)',
    'Component Extension' => 'Extensão de componente',
    'File extension for component files' => 'Extensão de ficheiro para os ficheiros de componentes',

    // Settings: Component Library
    'Component Library' => 'Biblioteca de componentes',
    'Enable Component Library' => 'Ativar biblioteca de componentes',
    'Enable the component library UI in the Control Panel' => 'Ativar a interface da biblioteca de componentes no painel de controlo',
    'Show Component Source' => 'Mostrar código-fonte do componente',
    'Show component source code in the library' => 'Mostrar o código-fonte do componente na biblioteca',
    'Enable Live Preview' => 'Ativar pré-visualização em direto',
    'Enable live component preview in the library' => 'Ativar a pré-visualização em direto do componente na biblioteca',
    'Metadata Fields' => 'Campos de metadados',
    'Custom metadata fields for components (one per line)' => 'Campos de metadados personalizados para componentes (um por linha)',

    // Settings: Interface
    'Interface' => 'Interface',
    'Interface Settings' => 'Definições da interface',

    // Components: Index
    'Discovered Components' => 'Componentes detetados',
    'View Documentation' => 'Ver documentação',
    'No components found. Make sure your component paths are configured correctly in Settings.' => 'Nenhum componente encontrado. Certifique-se de que os seus caminhos de componentes estão configurados corretamente nas definições.',

    // Components: Detail
    'Live Preview' => 'Pré-visualização em direto',
    'Examples' => 'Exemplos',
    'Source Code' => 'Código-fonte',
    'Usage Notes' => 'Notas de utilização',
    'Edit Props' => 'Editar props',

    // Component Library (Documentation page)
    'Grid View' => 'Vista em grelha',
    'List View' => 'Vista em lista',
    'Export Docs' => 'Exportar documentação',
    'Quick Navigation' => 'Navegação rápida',
    'Preview' => 'Pré-visualização',
    'Code' => 'Código',
    'Component Preview' => 'Pré-visualização do componente',
    'No Components Found' => 'Nenhum componente encontrado',
    'No components have been discovered yet. Make sure your component paths are configured correctly in the settings.' => 'Ainda não foram detetados componentes. Certifique-se de que os seus caminhos de componentes estão configurados corretamente nas definições.',

    // Utilities (Maintenance)
    'Maintenance' => 'Manutenção',
    'Component Cache' => 'Cache de componentes',
    'Clear the component discovery cache to force re-discovery of all components.' => 'Esvaziar a cache de deteção de componentes para forçar a nova deteção de todos os componentes.',
    'Clear Component Cache' => 'Esvaziar cache de componentes',
    'Are you sure you want to clear the component cache?' => 'Limpar a cache de componentes?',
    'Cache Duration:' => 'Duração da cache:',
    'Until manually cleared' => 'Até ser esvaziada manualmente',
    'seconds' => 'segundos',
    'Component caching is currently disabled. Enable it in the Features settings.' => 'A colocação em cache de componentes está atualmente desativada. Ative-a nas definições de funcionalidades.',
    'Usage Statistics' => 'Estatísticas de utilização',
    'Clear component usage statistics and tracking data.' => 'Eliminar as estatísticas de utilização e os dados de monitorização dos componentes.',
    'Clear Usage Statistics' => 'Eliminar estatísticas de utilização',
    'Are you sure you want to clear all usage statistics?' => 'Limpar todas as estatísticas de utilização?',
    'Usage tracking is currently disabled. Enable it in the Features settings.' => 'A monitorização de utilização está atualmente desativada. Ative-a nas definições de funcionalidades.',
    'Component Discovery' => 'Deteção de componentes',
    'Force re-discovery of all components from configured paths.' => 'Forçar a nova deteção de todos os componentes a partir dos caminhos configurados.',
    'Re-discover Components' => 'Detetar componentes novamente',
    'Currently searching in:' => 'A procurar atualmente em:',
    'System Information' => 'Informações do sistema',
    'Information about the Component Manager system.' => 'Informações sobre o sistema Component Manager.',
    'Plugin Version' => 'Versão do plugin',
    'Schema Version' => 'Versão do esquema',
    'Components Discovered' => 'Componentes detetados',
    'components' => 'componentes',
    'Cache Status' => 'Estado da cache',
    'Usage Tracking' => 'Monitorização de utilização',

    // Config overrides
    'This is being overridden by the `allowInlineComponents` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `allowInlineComponents` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `allowNesting` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `allowNesting` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `cacheDuration` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `cacheDuration` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `componentExtension` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `componentExtension` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `componentPaths` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `componentPaths` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `defaultPath` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `defaultPath` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `defaultSlotName` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `defaultSlotName` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableCache` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableCache` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableComponentLibrary` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableComponentLibrary` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableDebugMode` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableDebugMode` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableDocumentation` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableDocumentation` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableInheritance` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableInheritance` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableLivePreview` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableLivePreview` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enablePropValidation` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enablePropValidation` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `enableUsageTracking` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `enableUsageTracking` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `ignoreFolders` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `ignoreFolders` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `ignorePatterns` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `ignorePatterns` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `maxNestingDepth` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `maxNestingDepth` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `metadataFields` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `metadataFields` no ficheiro `config/component-manager.php`.',
    'This is being overridden by the `showComponentSource` setting in the `config/component-manager.php` file.' => 'Esta definição está a ser substituída pela definição `showComponentSource` no ficheiro `config/component-manager.php`.',
];
