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
            'person_id' => \App\Models\Person::factory(),
            'specialty_id' => \App\Models\Specialty::inRandomOrder()->first()->id,
            'license_number' => $this->faker->numerify('#########'),
        ];
    }
}
