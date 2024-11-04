<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'medical_office_id',
        'staff_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    public function getDurationAttribute()
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);

        $durationInMinutes = $startTime->diffInMinutes($endTime);

        $hours = intdiv($durationInMinutes, 60);
        $minutes = $durationInMinutes % 60;

        return ($hours > 0 ? "{$hours} hr " : "") . "{$minutes} min";
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function medicalOffice(): BelongsTo
    {
        return $this->belongsTo(MedicalOffice::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
