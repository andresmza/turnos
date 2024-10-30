<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pacientes';

    protected $fillable = [
        'persona_id',
        'obra_social_id',
        'numero_afiliado',
    ];  

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function obraSocial()
    {
        return $this->belongsTo(ObraSocial::class)->withTrashed();
    }

    public static function getAllPacientes()
    {
        return self::with('persona', 'obraSocial')->get();
    }
}
