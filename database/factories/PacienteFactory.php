<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'persona_id' => \App\Models\Persona::factory(),
            'obraSocial_id' => \App\Models\ObraSocial::factory(),
            'numero_afiliado' => $this->faker->numerify('##########'),
        ];
    }
}
