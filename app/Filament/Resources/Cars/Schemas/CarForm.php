<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconPosition;

use function Laravel\Prompts\search;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informatons Cars')
                ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-book-open')
                    ->schema([
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
                    ]),
                Section::make('Expiry Dates')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        DatePicker::make('insurance_expiry_date')
                            ->label('Insurance Expiry Date'),

                        DatePicker::make('registration_expiry_date')
                            ->label('Registration Expiry Date'),

                        DatePicker::make('inspection_expiry_date')
                            ->label('Inspection Expiry Date'),
                    ])
                    ->columns(1),

            ]);
    }
}
