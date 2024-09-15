<?php

namespace App\Helpers;

use App\Exceptions\ArrayLengthMismatchException;
use App\Exceptions\InvalidTypeException;

class ValidateVariableHelper
{
    public static function ensureStringKeyValuePairs(array $array): void
    {
        foreach ($array as $key => $value) {
            if (!is_string($key) || !is_string($value)) {
                throw new InvalidTypeException("The array must be structured as ['string' => 'string', '...' => '...'].");
            }
        }
    }

    public static function ensureStringValues(array $array): void
    {
        // Check if the array is associative
        if (array_keys($array) !== range(0, count($array) - 1)) {
            throw new InvalidTypeException("The array must be a non-associative array with only string values.");
        }

        foreach ($array as $value) {
            if (!is_string($value)) {
                throw new InvalidTypeException("The array must be structured as ['string', 'string', ...]");
            }
        }
    }

    public static function ensureArraysHaveSameLength(string $message, array $arrays): void
    {
        if (empty($arrays) || !is_array($arrays[0])) {
            throw new \InvalidArgumentException("The first argument must be an array containing other arrays.");
        }

        $length = count($arrays[0]);

        foreach ($arrays as $array) {
            if (!is_array($array) || count($array) !== $length) {
                throw new ArrayLengthMismatchException($message);
            }
        }
    }
}
