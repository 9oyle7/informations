<?php

namespace App\Filament\Resources\Cars\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand')->label('Brand')->sortable()->searchable(),
                // TextColumn::make('model')->label('Model')->sortable()->searchable(),
                // TextColumn::make('year')->label('Year')->sortable()->searchable(),
                // TextColumn::make('description')->label('Description')->sortable()->searchable(),
                // TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('insurance_expiry_date')
                    ->label('Insurance Expiry Date')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->color(
                        fn($record) =>
                        $record->insurance_expiry_date?->isPast()
                            ? 'danger'
                            : ($record->insurance_expiry_date?->lessThan(now()->addDays(30))
                                ? 'warning'
                                : 'success')
                    ),
                TextColumn::make('registration_expiry_date')
                    ->label('Registration Expiry Date')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->color(
                        fn($record) =>
                        $record->insurance_expiry_date?->isPast()
                            ? 'danger'
                            : ($record->insurance_expiry_date?->lessThan(now()->addDays(30))
                                ? 'warning'
                                : 'success')
                    ),
                TextColumn::make('inspection_expiry_date')
                    ->label('Inspection Expiry Date')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->color(
                        fn($record) =>
                        $record->insurance_expiry_date?->isPast()
                            ? 'danger'
                            : ($record->insurance_expiry_date?->lessThan(now()->addDays(30))
                                ? 'warning'
                                : 'success')
                    ),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
