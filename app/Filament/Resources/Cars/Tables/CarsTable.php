<?php

namespace App\Filament\Resources\Cars\Tables;

use Carbon\Carbon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class CarsTable
{
    /**
     * تحديد حالة الانتهاء (لون + أيقونة + نص)
     */
    private static function expiryStatus(?Carbon $date): array
    {
        if (! $date) {
            return [
                'label' => 'N/A',
                'color' => 'gray',
                'icon'  => 'heroicon-o-question-mark-circle',
            ];
        }

        if ($date->isPast()) {
            return [
                'label' => $date->format('Y-m-d'),
                'color' => 'danger',
                'icon'  => 'heroicon-o-clock',
            ];
        }

        if ($date->lessThan(now()->addDays(30))) {
            return [
                'label' => $date->format('Y-m-d'),
                'color' => 'warning',
                'icon'  => 'heroicon-o-exclamation-triangle',
            ];
        }

        return [
            'label' => $date->format('Y-m-d'),
            'color' => 'success',
            'icon'  => 'heroicon-o-check-circle',
        ];
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand')
                    ->label('Brand')
                    ->sortable()
                    ->searchable(),

                // انتهاء التأمين
                TextColumn::make('insurance_expiry_date')
                    ->label('Insurance Expiry Date')
                    ->badge()
                    ->getStateUsing(fn ($record) =>
                        self::expiryStatus($record->insurance_expiry_date)['label']
                    )
                    ->color(fn ($record) =>
                        self::expiryStatus($record->insurance_expiry_date)['color']
                    )
                    ->icon(fn ($record) =>
                        self::expiryStatus($record->insurance_expiry_date)['icon']
                    ),

                // انتهاء الاستمارة
                TextColumn::make('registration_expiry_date')
                    ->label('Registration Expiry Date')
                    ->badge()
                    ->getStateUsing(fn ($record) =>
                        self::expiryStatus($record->registration_expiry_date)['label']
                    )
                    ->color(fn ($record) =>
                        self::expiryStatus($record->registration_expiry_date)['color']
                    )
                    ->icon(fn ($record) =>
                        self::expiryStatus($record->registration_expiry_date)['icon']
                    ),

                // انتهاء الفحص
                TextColumn::make('inspection_expiry_date')
                    ->label('inspection Expiry Date')
                    ->badge()
                    ->getStateUsing(fn ($record) =>
                        self::expiryStatus($record->inspection_expiry_date)['label']
                    )
                    ->color(fn ($record) =>
                        self::expiryStatus($record->inspection_expiry_date)['color']
                    )
                    ->icon(fn ($record) =>
                        self::expiryStatus($record->inspection_expiry_date)['icon']
                    ),
            ])

            ->filters([
                SelectFilter::make('expiry_status')
                    ->label('expiry status')
                    ->options([
                        'expired' => 'expired',
                        'soon'    => 'soon to expire (30 days)',
                        'valid'   => 'valid (more than 30 days)',
                    ])
                    ->query(function ($query, array $data) {
                        if (! $data['value']) {
                            return;
                        }

                        match ($data['value']) {
                            'expired' => $query->where(function ($q) {
                                $q->whereDate('insurance_expiry_date', '<', now())
                                  ->orWhereDate('registration_expiry_date', '<', now())
                                  ->orWhereDate('inspection_expiry_date', '<', now());
                            }),

                            'soon' => $query->where(function ($q) {
                                $q->whereBetween('insurance_expiry_date', [now(), now()->addDays(30)])
                                  ->orWhereBetween('registration_expiry_date', [now(), now()->addDays(30)])
                                  ->orWhereBetween('inspection_expiry_date', [now(), now()->addDays(30)]);
                            }),

                            'valid' => $query->where(function ($q) {
                                $q->whereDate('insurance_expiry_date', '>=', now()->addDays(30))
                                  ->whereDate('registration_expiry_date', '>=', now()->addDays(30))
                                  ->whereDate('inspection_expiry_date', '>=', now()->addDays(30));
                            }),
                        };
                    }),
            ])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
