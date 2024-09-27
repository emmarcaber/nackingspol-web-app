<?php

namespace App\Policies;

use App\Models\Size;

class SizePolicy extends BasePolicy
{
    public function model(): string
    {
        return Size::class;
    }
}