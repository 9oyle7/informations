<?php

namespace App\Filament\Resources\Maintenances\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\View;
use Filament\Tables\Columns\TextColumn;

class MaintenancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('car.model')
                ->label('السيارة')
                ->sortable()
                ->searchable(),

            TextColumn::make('type.name')
                ->label('نوع الصيانة')
                ->sortable()
                ->searchable(),

            TextColumn::make('mileage')
                ->label('العداد'),

            TextColumn::make('cost')
                ->label('التكلفة')
                ->money('SAR'),

            TextColumn::make('serviced_at')
                ->label('تاريخ الصيانة')
                ->date()
                ->sortable(),

                ])

            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
