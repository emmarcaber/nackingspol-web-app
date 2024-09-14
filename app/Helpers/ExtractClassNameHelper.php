<?php

namespace App\Helpers;

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
     * @param string $fullyQualifiedClassName
     * @return string
     */
    public static function extract(string $fullyQualifiedClassName): string
    {
        $parts = explode('\\', $fullyQualifiedClassName);
        return strtolower(end($parts));
    }
}
