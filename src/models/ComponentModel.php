<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\models;

use craft\base\Model;

/**
 * Component Model
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class ComponentModel extends Model
{
    /**
     * @var string Component name (e.g., "forms/input")
     */
    public string $name = '';
    
    /**
     * @var string Full file path
     */
    public string $path = '';
    
    /**
     * @var string Relative path from base
     */
    public string $relativePath = '';
    
    /**
     * @var string Base path
     */
    public string $basePath = '';
    
    /**
     * @var string|null Component description
     */
    public ?string $description = null;
    
    /**
     * @var string|null Component category
     */
    public ?string $category = null;
    
    /**
     * @var array Component props definition
     */
    public array $props = [];
    
    /**
     * @var array Available slots
     */
    public array $slots = [];
    
    /**
     * @var string|null Parent component
     */
    public ?string $extends = null;
    
    /**
     * @var array Component metadata
     */
    public array $metadata = [];
    
    /**
     * @var int Usage count
     */
    public int $usageCount = 0;
    
    /**
     * @var array Example usage
     */
    public array $examples = [];

    /**
     * Get the component's namespace (folder path)
     *
     * @return string|null
     */
    public function getNamespace(): ?string
    {
        $parts = explode('/', $this->name);
        if (count($parts) > 1) {
            array_pop($parts);
            return implode('/', $parts);
        }
        return null;
    }

    /**
     * Get the component's base name (without namespace)
     *
     * @return string
     */
    public function getBaseName(): string
    {
        $parts = explode('/', $this->name);
        return array_pop($parts);
    }

    /**
     * Get required props
     *
     * @return array
     */
    public function getRequiredProps(): array
    {
        $required = [];
        foreach ($this->props as $name => $config) {
            if (is_array($config) && ($config['required'] ?? false)) {
                $required[] = $name;
            }
        }
        return $required;
    }

    /**
     * Get optional props
     *
     * @return array
     */
    public function getOptionalProps(): array
    {
        $optional = [];
        foreach ($this->props as $name => $config) {
            if (is_array($config) && !($config['required'] ?? false)) {
                $optional[] = $name;
            } elseif (!is_array($config)) {
                $optional[] = $name;
            }
        }
        return $optional;
    }

    /**
     * Validate props
     *
     * @param array $props
     * @return array Validation errors
     */
    public function validateProps(array $props): array
    {
        $errors = [];
        
        // Check required props
        foreach ($this->getRequiredProps() as $requiredProp) {
            if (!array_key_exists($requiredProp, $props)) {
                $errors[] = "Required prop '{$requiredProp}' is missing";
            }
        }
        
        // Validate prop types if specified
        foreach ($props as $name => $value) {
            if (isset($this->props[$name]) && is_array($this->props[$name])) {
                $config = $this->props[$name];
                
                // Type validation
                if (isset($config['type'])) {
                    $type = $config['type'];
                    $valid = match ($type) {
                        'string' => is_string($value),
                        'int', 'integer' => is_int($value),
                        'float', 'double' => is_float($value),
                        'bool', 'boolean' => is_bool($value),
                        'array' => is_array($value),
                        'object' => is_object($value),
                        default => true
                    };
                    
                    if (!$valid) {
                        $errors[] = "Prop '{$name}' must be of type {$type}";
                    }
                }
                
                // Enum validation
                if (isset($config['enum']) && is_array($config['enum'])) {
                    if (!in_array($value, $config['enum'])) {
                        $options = implode(', ', $config['enum']);
                        $errors[] = "Prop '{$name}' must be one of: {$options}";
                    }
                }
                
                // Pattern validation
                if (isset($config['pattern']) && is_string($value)) {
                    if (!preg_match($config['pattern'], $value)) {
                        $errors[] = "Prop '{$name}' does not match required pattern";
                    }
                }
            }
        }
        
        return $errors;
    }

    /**
     * Get prop default value
     *
     * @param string $name
     * @return mixed
     */
    public function getPropDefault(string $name): mixed
    {
        if (isset($this->props[$name]) && is_array($this->props[$name])) {
            return $this->props[$name]['default'] ?? null;
        }
        return null;
    }

    /**
     * Apply default values to props
     *
     * @param array $props
     * @return array
     */
    public function applyDefaults(array $props): array
    {
        foreach ($this->props as $name => $config) {
            if (!array_key_exists($name, $props) && is_array($config) && isset($config['default'])) {
                $props[$name] = $config['default'];
            }
        }
        return $props;
    }
}
