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
                'Ugaone garniture', 'Trosedi i dvosedi', 'TV komode', 'Klub stolovi', 'Fotelje'
            ],
            'Spavaća soba' => [
                'Bračni kreveti', 'Dušeci', 'Ormari', 'Noćni ormarići', 'Toaletni stolovi'
            ],
            'Trpezarija' => [
                'Trpezarijski stolovi', 'Stolice', 'Komode za posuđe', 'Vitrine'
            ],
            'Kuhinja' => [
                'Kompletne kuhinje', 'Kuhinjski elementi', 'Barske stolice', 'Radne ploče'
            ],
            'Radna soba' => [
                'Radni stolovi', 'Kancelarijske stolice', 'Police za knjige', 'Fiokari'
            ],
            'Predsoblje' => [
                'Cipelarnici', 'Čiviluci', 'Ogledala', 'Klupe za predsoblje'
            ],
            'Bašta i terasa' => [
                'Baštenske garniture', 'Ležaljke', 'Suncobrani', 'Spoljna rasveta'
            ],
        ];

        foreach ($data as $mainCategory => $subCategories) {
            $parent = Category::create([
                'name' => $mainCategory,
                'slug' => Str::slug($mainCategory),
                'parent_id' => null,
            ]);

            foreach ($subCategories as $subName) {
                Category::create([
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
