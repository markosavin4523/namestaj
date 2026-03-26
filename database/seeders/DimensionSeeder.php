<?php

namespace Database\Seeders;

use App\Models\Dimension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 240) as $id) {
            Dimension::create([
                'product_id' => $id,
                'width'      => rand(40, 220),
                'height'     => rand(45, 210),
                'depth'      => rand(35, 90),
            ]);
        }
    }
}
