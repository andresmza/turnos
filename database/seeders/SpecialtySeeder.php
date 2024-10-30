<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
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
            'Podología',
        ];
        foreach ($specialties as $name) {
            Specialty::create(['name' => $name]);
        }
        }
    }
