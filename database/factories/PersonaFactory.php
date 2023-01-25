<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'dni' => "12345678",
            'telefono' => fake()->phoneNumber(),
            'tipo' => 'facilitador_centro'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function alumno(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'alumno',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function facilitadorCentro(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'facilitador_centro',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function facilitadorEmpresa(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'facilitador_empresa',
        ]);
    }


}
