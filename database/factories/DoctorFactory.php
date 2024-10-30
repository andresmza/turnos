<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => \App\Models\User::factory(),
            'persona_id' => \App\Models\Persona::factory(),
            'especialidad_id' => \App\Models\Especialidad::inRandomOrder()->first()->id,
            'matricula' => $this->faker->numerify('#########'),
        ];
    }
}
