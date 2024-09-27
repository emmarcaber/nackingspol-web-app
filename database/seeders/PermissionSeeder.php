<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\WaterType;
use Illuminate\Database\Seeder;
use App\Helpers\RolePermissionFactoryHelper;
use App\Types\RoleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RolePermissionFactoryHelper::make(User::class);

        RolePermissionFactoryHelper::make(WaterType::class)
            ->addPermissions([
                RoleType::CASHIER => [
                    'view any',
                    'view',
                    'create',
                    'update',
                ]
            ]);

        RolePermissionFactoryHelper::make(Size::class)
            ->addPermissions([
                RoleType::CASHIER => [
                    'view any',
                    'view',
                    'create',
                    'update',
                ]
            ]);

        RolePermissionFactoryHelper::make(Customer::class)
            ->addPermissions([
                RoleType::CASHIER => [
                    'view any',
                    'view',
                    'create',
                    'update',
                ]
            ]);

        RolePermissionFactoryHelper::make(Order::class)
            ->addPermissions([
                RoleType::CASHIER => [
                    'view any',
                    'view',
                    'create',
                    'update',
                ]
            ]);

        RolePermissionFactoryHelper::make(Product::class)
            ->addPermissions([
                RoleType::CASHIER => [
                    'view any',
                    'view',
                    'create',
                    'update',
                ]
            ]);
    }
}
