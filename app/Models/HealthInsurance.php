<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthInsurance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'health_insurances';

    protected $fillable = ['name'];

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
