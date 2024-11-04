<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'specialties';

    protected $fillable = ['name'];

    public static function specialtyWithDoctors()
    {
        return self::whereHas('doctors')
            ->with('doctors')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public static function getAllSpecialties()
    {
        return self::all();
    }
}
