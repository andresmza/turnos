<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            'Medicina General',
            'Pediatría',
            'Dermatología',
            'Psiquiatría',
            'Nutrición',
            'Psicología',
            'Endocrinología',
            'Ginecología',
            'Oftalmología',
            'Otorrinolaringología',
            'Reumatología',
            'Cardiología',
            'Gastroenterología',
            'Neurología',
            'Medicina Interna',
        ];

        foreach ($especialidades as $nombre) {
            Especialidad::create(['nombre' => $nombre]);
        }
    }
}
