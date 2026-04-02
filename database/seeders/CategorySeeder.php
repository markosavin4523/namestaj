<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Dnevna soba' => [
                'Garniture', 'TV komode', 'Klub stolovi', 'Fotelje'
            ],
            'Spavaća soba' => [
                'Bračni kreveti', 'Dušeci', 'Ormari', 'Noćni ormarići',
            ],
            'Trpezarija' => [
                'Trpezarijski stolovi', 'Stolice', 'Komode za posuđe', 'Vitrine'
            ],
            'Kuhinja' => [
                'Kompletne kuhinje', 'Kuhinjski elementi', 'Barske stolice', 'Radne ploče'
            ],
            'Radna soba' => [
                'Radni stolovi', 'Kancelarijske stolice', 'Police za knjige', 'Fiokari'
            ]
        ];

        foreach ($data as $mainCategory => $subCategories) {
            $parent = Category::create([
                'name' => $mainCategory,
                'slug' => Str::slug($mainCategory),
                'parent_id' => null,
            ]);
            $parent->image()->create([
                'path' => Str::slug($mainCategory) . '.jpg',
                'alt' => "Nameštaj za $mainCategory"
            ]);
            foreach ($subCategories as $subName) {
                $category = Category::create([
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'parent_id' => $parent->id,
                ]);
                $category->image()->create([
                    'path' => Str::slug($subName) . '.jpg',
                    'alt' => "Nameštaj za $subName"
                ]);
            }
        }
        //Oglasi iz izbrisane kategorije idu ovde
        $unactiveCat = Category::create([
            'name' => 'Ostalo',
            'slug' => Str::slug('Ostalo'),
            'parent_id' => null,
            "active" => false
        ]);
        Category::create([
            "name"=>"nekategorizovano",
            "slug"=>"nekategorizovano",
            "parent_id" => $unactiveCat->id,
            "active" => false
        ]);

    }
}
