<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call(CitiesSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(OrderStatusSeeder::class);
        User::factory(10)->create();
        User::create([
            "first_name" => "Marko",
            "last_name" => "Savin",
            "username" => "admin",
            "email"=> "admin@gmail.com",
            "password"=> Hash::make("admin123"),
            "role_id"=> 1,
        ]);
        User::create([
            "first_name" => "Petar",
            "last_name" => "Peric",
            "username" => "pera.peric",
            "email"=> "pera@gmail.com",
            "password"=> Hash::make("pera123"),
            "role_id"=> 3,
        ]);
        Product::factory(240)->create();
        $this->call(DimensionSeeder::class);
        $this->call(OrderSeeder::class);
        Contact::factory(15)->create();
    }
}
