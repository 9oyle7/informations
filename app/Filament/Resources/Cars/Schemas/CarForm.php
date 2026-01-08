<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

use function Laravel\Prompts\search;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->label('Brand')
                    ->required(),
                TextInput::make('model')
                    ->label('Model')
                    ->required(),
                Select::make('year')
                    ->label('Year')
                    ->options(
                        collect(range(date('Y'), 2000)) // السنوات من الآن إلى 1990
                            ->mapWithKeys(fn($y) => [(string) $y => (string) $y])
                            ->toArray()
                    )
                    ->searchable()
                    ->required(),
                TextInput::make('description')
                    ->label('Description')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }
}
