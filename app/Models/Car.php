<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'description',
        'insurance_expiry_date',
        'registration_expiry_date',
        'inspection_expiry_date',
    ];

        protected $casts = [
        'insurance_expiry_date' => 'date',
        'registration_expiry_date' => 'date',
        'inspection_expiry_date' => 'date',
    ];

    // أقرب تاريخ انتهاء
    public function nearestExpiry(): ?Carbon
    {
        return collect([
            $this->insurance_expiry_date,
            $this->registration_expiry_date,
            $this->inspection_expiry_date,
        ])->filter()->min();
    }

    // حالة السيارة
    public function status(): string
    {
        $date = $this->nearestExpiry();

        if (!$date) return 'unknown';
        if ($date->isPast()) return 'expired';
        if ($date->lessThanOrEqualTo(now()->addDays(30))) return 'near';

        return 'ok';
    }
}
