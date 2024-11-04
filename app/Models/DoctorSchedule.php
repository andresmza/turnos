<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'appointment_duration',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
