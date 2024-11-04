<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Andrés',
            'email' => 'andres.mza25@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $this->call([
            SpecialtySeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            PeopleSeeder::class,
            MedicalOfficeSeeder::class,
        ]);
    }
}
