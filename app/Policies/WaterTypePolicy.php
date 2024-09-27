<?php

namespace App\Policies;

use App\Models\WaterType;

class WaterTypePolicy extends BasePolicy
{
    public function model(): string
    {
        return WaterType::class;
    }
}