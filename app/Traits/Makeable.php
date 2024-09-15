<?php

namespace App\Traits;

/**
 * The Makeable trait provides a simple factory method to instantiate a class
 * by calling `make` with any number of arguments. This pattern is useful
 * when you want a more expressive way to create new objects.
 */
trait Makeable
{
    /**
     * A static factory method that instantiates a new object of the calling class
     * using any number of arguments passed to it.
     *
     * @param mixed ...$attributes The arguments to be passed to the constructor of the class.
     * @return static A new instance of the class with the passed attributes.
     */
    public static function make(...$attributes)
    {
        // Use the static class context to create a new instance of the calling class
        return new static(...$attributes);
    }
}
