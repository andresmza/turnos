<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalOffice;

class MedicalOfficeSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 7; $i++) {
            MedicalOffice::create([
                'number' => 'Consultorio ' . $i,
            ]);
        }
    }
}
