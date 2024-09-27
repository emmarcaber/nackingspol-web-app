<?php

namespace App\Policies;

use App\Models\Customer;

class CustomerPolicy extends BasePolicy
{
    public function model(): string
    {
        return Customer::class;
    }
}