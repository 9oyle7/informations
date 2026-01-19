<?php

namespace App\Filament\Resources\MaintenanceTypes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class MaintenanceTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

            TextInput::make('name')
                ->label('Maintenance Type Name')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            ]);
    }
}
