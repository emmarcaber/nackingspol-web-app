<?php

namespace App\Traits;

trait Makeable
{
    public static function make(...$attributes)
    {
        return new static(...$attributes);
    }
}
