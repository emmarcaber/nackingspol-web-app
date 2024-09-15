<?php

namespace App\Types;

use App\Helpers\ValidateVariableHelper;

/**
 * The BaseType class serves as an abstract base for classes that manage
 * different types, selection types, and their corresponding default colors.
 * It provides validation for ensuring that the data structures are properly
 * formatted and aligned in length.
 */
abstract class BaseType
{
    /**
     * @var array Holds the types of the derived class.
     */
    private array $types;

    /**
     * @var array Holds the selection types for the derived class.
     */
    private array $selectionTypes;

    /**
     * @var array Holds the default colors mapped to types.
     */
    private array $defaultColors = [];

    /**
     * Method to be implemented by child classes to set the types.
     *
     * @return array An array of string values representing the types.
     */
    abstract public function setTypes(): array;

    /**
     * Method to be implemented by child classes to set the selection types.
     *
     * @return array An associative array where keys are types and values are selection types.
     */
    abstract public function setSelectionTypes(): array;

    /**
     * Method to be implemented by child classes to set default colors.
     *
     * @return array An associative array where keys are types and values are default colors.
     */
    abstract public function setDefaultColors(): array;

    /**
     * BaseType constructor.
     * Initializes the types, selection types, and default colors, and validates their structure.
     */
    public function __construct()
    {
        // Initialize class properties with the values returned by respective methods
        $this->types = $this->types();
        $this->selectionTypes = $this->selectionTypes();
        $this->defaultColors = $this->defaultColors();

        // Validate the structure of selection types and default colors (must be string key-value pairs)
        ValidateVariableHelper::ensureStringKeyValuePairs($this->selectionTypes);
        ValidateVariableHelper::ensureStringKeyValuePairs($this->defaultColors);

        // Validate that types contain only strings
        ValidateVariableHelper::ensureStringValues($this->types);

        // Ensure that the types, selection types, and default colors arrays have the same length
        ValidateVariableHelper::ensureArraysHaveSameLength(
            'The types and selection types array must have the same length.',
            [$this->types, $this->selectionTypes, $this->defaultColors]
        );
    }

    /**
     * Get the types array.
     *
     * @return array An array of types.
     */
    public function types(): array
    {
        return $this->types;
    }

    /**
     * Get the selection types array.
     *
     * @return array An associative array of selection types.
     */
    public function selectionTypes(): array
    {
        return $this->selectionTypes();
    }

    /**
     * Get the default colors array.
     *
     * @return array An associative array of default colors mapped to types.
     */
    public function defaultColors(): array
    {
        return $this->defaultColors;
    }

    /**
     * Retrieve the default color for a specific type.
     *
     * @param string $type The type for which the default color is requested.
     * @return string The default color corresponding to the type.
     */
    public function getDefaultColor(string $type): string
    {
        return $this->defaultColors[$type];
    }
}
