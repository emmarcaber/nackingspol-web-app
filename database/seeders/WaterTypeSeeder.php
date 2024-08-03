<?php

namespace Database\Seeders;

use App\Models\WaterType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $waterTypes = [
            'Alkaline', 'Mineral'
        ];

        foreach ($waterTypes as $waterType) {
            WaterType::firstOrCreate([
                'name' => $waterType,
            ]);
        }
    }
}
