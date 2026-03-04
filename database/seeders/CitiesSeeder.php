<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Beograd', 'Novi Sad', 'Niš', 'Kragujevac', 'Subotica',
            'Zrenjanin', 'Pancevo', 'Kraljevo', 'Kruševac', 'Čačak', 'Leskovac',
            'Valjevo', 'Vranje', 'Senta', 'Sombor', 'Šabac',
            'Pirot', 'Apatin', 'Vršac', 'Jagodina', 'Požarevac'
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
