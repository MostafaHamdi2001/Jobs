<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['hex' => '#FF0000'],
            ['hex' => '#00FF00'],
            ['hex' => '#0000FF'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
