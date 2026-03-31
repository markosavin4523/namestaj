<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses    = [
            'U obradi',
            'Isporuceno kurirskoj sluzbi',
            'Dovrseno',
            "Otkazano"
        ];

        foreach ($statuses as $s) {
            OrderStatus::create(['name' => $s]);
        }
    }
}
