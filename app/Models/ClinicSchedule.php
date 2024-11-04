<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicSchedule extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla en la base de datos (opcional si sigue la convención)
    protected $table = 'clinic_schedules';

    // Atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'medical_office_id',
        'date',
        'start_time',
        'end_time',
    ];

    /**
     * Relación con el modelo MedicalOffice.
     * Un horario de clínica pertenece a una oficina médica.
     */
    public function medicalOffice()
    {
        return $this->belongsTo(MedicalOffice::class);
    }

    /**
     * Relación con el modelo DoctorSchedule.
     * Un horario de clínica puede tener múltiples horarios de doctores asociados.
     */
    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
