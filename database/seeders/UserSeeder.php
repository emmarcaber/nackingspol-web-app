<?php

namespace Database\Seeders;

use App\Models\User;
use App\Types\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@nackingspol.com',
                'password' => "$2y$12\$c5Zfomk1whNFcD.OoahRA.KyOzAf5jSHRJFhZtDK3qivB/uYV3GLq",
                'role' => RoleType::SUPER_ADMIN
            ],
            [
                'name' => 'Cashier',
                'email' => 'cashier@nackingspol.com',
                'password' => "$2y$12\$LFzhjv4DliJU2r7MeAK8CuM3HJDCW49jYrZpEeE/MvwjaQJr/mTUu",
                'role' => RoleType::CASHIER,
            ]
        ];

        foreach ($users as $userData) {
            DB::transaction(function () use ($userData) {
                $userDataWithoutRole = $userData;
                unset($userDataWithoutRole['role']);

                $user = User::firstOrCreate(['email' => $userDataWithoutRole['email']], $userDataWithoutRole);
                $user->assignRole($userData['role']);
            });
        }
    }
}
