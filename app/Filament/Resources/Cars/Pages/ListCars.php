<?php

namespace App\Filament\Resources\Cars\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Cars\Widgets\CarExpiryStats;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Cars\CarResource;

class ListCars extends ListRecords
{
    protected static string $resource = CarResource::class;

        protected function getHeaderWidgets(): array
    {
        return [
            CarExpiryStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
