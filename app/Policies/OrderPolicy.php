<?php

namespace App\Policies;

use App\Models\Order;

class OrderPolicy extends BasePolicy
{
    public function model(): string
    {
        return Order::class;
    }
}