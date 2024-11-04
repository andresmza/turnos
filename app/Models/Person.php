<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'document',
        'first_name',
        'last_name',
        'phone',
        'email',
        'birth_date',
        'gender',
    ];

    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class);
    }

    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }
}
