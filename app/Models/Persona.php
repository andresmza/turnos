<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'fecha_nacimiento',
        'sexo',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

}
