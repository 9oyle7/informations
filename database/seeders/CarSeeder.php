<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'year' => 2018,
            'description' => 'A reliable family car.',
        ]);
        Car::create([
            'brand' => 'Chevrolet',
            'model' => 'Suburban',
            'year' => 2015,
            'description' => 'A reliable family car.',
        ]);
        Car::create([
            'brand' => 'Ford',
            'model' => 'Crown Victoria',
            'year' => 2011,
            'description' => 'A reliable family car.',
        ]);
    }
}
