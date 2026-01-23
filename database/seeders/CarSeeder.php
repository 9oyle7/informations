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
            'insurance_expiry_date' => now()->addDays(10),
            'registration_expiry_date' => now()->addDays(20),
            'inspection_expiry_date' => now()->addDays(30),
        ]);
        Car::create([
            'brand' => 'Chevrolet',
            'model' => 'Suburban',
            'year' => 2015,
            'description' => 'A reliable family car.',
            'insurance_expiry_date' => now()->addDays(15),
            'registration_expiry_date' => now()->addDays(25),
            'inspection_expiry_date' => now()->addDays(35),
        ]);
        Car::create([
            'brand' => 'Ford',
            'model' => 'Crown Victoria',
            'year' => 2011,
            'description' => 'A reliable family car.',
            'insurance_expiry_date' => now()->subDays(5),
            'registration_expiry_date' => now()->subDays(2),
            'inspection_expiry_date' => now()->addDays(40),
        ]);
    }
}
