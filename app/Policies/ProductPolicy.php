<?php

namespace App\Policies;

use App\Models\Product;

class ProductPolicy extends BasePolicy
{
    public function model(): string
    {
        return Product::class;
    }
}