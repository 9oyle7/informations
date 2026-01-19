<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceType extends Model
{
    protected $fillable = ['name'];

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
