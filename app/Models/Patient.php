<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patients';

    protected $fillable = [
        'person_id',
        'health_insurance_id',
        'affiliate_number',
    ];  

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id', 'people');
    }

    public function healthInsurance(): BelongsTo
    {
        return $this->belongsTo(HealthInsurance::class)->withTrashed();
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public static function getAllPatients()
    {
        return self::with('person', 'healthInsurance')->get();
    }
}
