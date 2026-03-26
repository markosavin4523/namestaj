<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 240) as $id) {
            Price::create([
                'product_id' => $id,
                'value'      => rand(1000, 10000),
                'date_from'  => now(),
                'date_to'    => null,
            ]);
        }
    }
}
