<?php

namespace App\Helpers;

use App\Exceptions\ArrayLengthMismatchException;
use App\Exceptions\InvalidTypeException;

/**
 * Class ValidateVariableHelper
 *
 * Provides static methods for validating arrays used in the application.
 * Includes checks for ensuring correct data types and array length consistency.
 *
 * @package App\Helpers
 */
class ValidateVariableHelper
{
    /**
     * Ensures that an associative array contains only string keys and string values.
     *
     * @param array $array The associative array to validate.
     * @throws InvalidTypeException If any key or value is not a string.
     */
    public static function ensureStringKeyValuePairs(array $array): void
    {
        foreach ($array as $key => $value) {
            // Check if both key and value are strings
            if (!is_string($key) || !is_string($value)) {
                throw new InvalidTypeException("The array must be structured as ['string' => 'string', '...' => '...'].");
            }
        }
    }

    /**
     * Ensures that a non-associative array contains only string values.
     *
     * @param array $array The non-associative array to validate.
     * @throws InvalidTypeException If the array is associative or contains non-string values.
     */
    public static function ensureStringValues(array $array): void
    {
        // Check if the array is associative (i.e., not sequentially indexed)
        if (array_keys($array) !== range(0, count($array) - 1)) {
            throw new InvalidTypeException("The array must be a non-associative array with only string values.");
        }

        // Ensure all values in the array are strings
        foreach ($array as $value) {
            if (!is_string($value)) {
                throw new InvalidTypeException("The array must be structured as ['string', 'string', ...]");
            }
        }
    }

    /**
     * Ensures that all arrays in the provided list have the same length.
     *
     * @param string $message The error message to display if array lengths do not match.
     * @param array $arrays An array of arrays to validate.
     * @throws ArrayLengthMismatchException If any array has a different length.
     * @throws \InvalidArgumentException If the input is not an array of arrays.
     */
    public static function ensureArraysHaveSameLength(string $message, array $arrays): void
    {
        // Ensure the input is an array of arrays and at least one array exists
        if (empty($arrays) || !is_array($arrays[0])) {
            throw new \InvalidArgumentException("The first argument must be an array containing other arrays.");
        }

        // Get the length of the first array to compare with others
        $length = count($arrays[0]);

        // Check that all arrays have the same length
        foreach ($arrays as $array) {
            if (!is_array($array) || count($array) !== $length) {
                throw new ArrayLengthMismatchException($message);
            }
        }
    }
}
