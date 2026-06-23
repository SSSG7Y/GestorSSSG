<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    public function run(): void
    {
        Label::create([
            'nombre' => 'Backend',
            'color' => '#3B82F6'
        ]);

        Label::create([
            'nombre' => 'Frontend',
            'color' => '#10B981'
        ]);

        Label::create([
            'nombre' => 'Urgente',
            'color' => '#EF4444'
        ]);
    }
}