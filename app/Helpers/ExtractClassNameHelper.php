<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Class ExtractClassNameHelper
 *
 * This class is used to extract the class name from a fully qualified class name.
 *
 * @package App\Helpers
 */
class ExtractClassNameHelper
{
    /**
     * Extracts the class name from a fully qualified class name.
     *
     * @param string $class
     * @return string
     */
    public static function extract(string $class): string
    {
        // Remove the namespace and "::class" if present
        $className = class_basename($class);

        // Convert CamelCase to words separated by spaces using Str::of and other methods
        return Str::of($className)
            ->snake()
            ->replace('_', ' ')
            ->lower();
    }
}
