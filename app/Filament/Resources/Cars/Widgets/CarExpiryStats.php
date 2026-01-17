<?php

namespace App\Filament\Resources\Cars\Widgets;

use App\Models\Car;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CarExpiryStats extends StatsOverviewWidget
{
protected static bool $isDiscovered = false;

    protected function getStats(): array
    {
        $expired = Car::where(function ($q) {
            $q->whereDate('insurance_expiry_date', '<', now())
              ->orWhereDate('registration_expiry_date', '<', now())
              ->orWhereDate('inspection_expiry_date', '<', now());
        })->count();

        $soon = Car::where(function ($q) {
            $q->whereBetween('insurance_expiry_date', [now(), now()->addDays(30)])
              ->orWhereBetween('registration_expiry_date', [now(), now()->addDays(30)])
              ->orWhereBetween('inspection_expiry_date', [now(), now()->addDays(30)]);
        })->count();

        $valid = Car::where(function ($q) {
            $q->whereDate('insurance_expiry_date', '>=', now()->addDays(30))
              ->whereDate('registration_expiry_date', '>=', now()->addDays(30))
              ->whereDate('inspection_expiry_date', '>=', now()->addDays(30));
        })->count();

        return [
            Stat::make('🚨 سيارات منتهية', $expired)->color('danger'),
            Stat::make('⏳ قريبة الانتهاء', $soon)->color('warning'),
            Stat::make('✅ سيارات سليمة', $valid)->color('success'),
        ];
    }
}
