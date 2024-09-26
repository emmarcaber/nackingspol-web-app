<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Helpers\RolePermissionFactoryHelper;
use App\Models\WaterType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RolePermissionFactoryHelper::make(User::class);
        RolePermissionFactoryHelper::make(WaterType::class);
    }
}
