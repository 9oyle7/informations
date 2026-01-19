<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class MaintenanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_id')
                    ->label('السيارة')
                    ->relationship('car', 'model')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('maintenance_type_id')
                    ->label('نوع الصيانة')
                    ->relationship('type', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('اسم نوع الصيانة')
                            ->required()
                            ->unique(),
                    ]),

                TextInput::make('mileage')
                    ->label('عداد السيارة')
                    ->numeric(),

                TextInput::make('cost')
                    ->label('التكلفة')
                    ->numeric()
                    ->prefix('ر.س'),

                DatePicker::make('serviced_at')
                    ->label('تاريخ الصيانة')
                    ->required(),

                Textarea::make('notes')
                    ->label('ملاحظات')
                    ->columnSpanFull(),
            ]);
    }
}
