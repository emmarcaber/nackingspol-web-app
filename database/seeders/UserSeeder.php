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
                'password' => bcrypt('nackingspol2022'),
                'role' => RoleType::SUPER_ADMIN
            ],
            [
                'name' => 'Mary Joy Bedico',
                'email' => 'mjbedico@nackingspol.com',
                'password' => bcrypt('mjbediconackingspol2022'),
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
