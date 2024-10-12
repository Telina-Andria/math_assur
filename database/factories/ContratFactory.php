<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contrat>
 */
class ContratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_contrat' => fake()->unique()->numerify('C#######'),
            'type_contrat' => fake()->randomElement(['vie', 'non vie']),
            'montant_assure' => fake()->randomFloat(2, 200_000, 20_000_000), // Montant entre 200000 AR, 20000000 ar
            'duree_contrat' => fake()->numberBetween(1, 30), // Durée entre 1 et 30 mois
            'date_fin' => fake()->date('Y-m-d', '+5 years'), // Date de fin dans 5 ans
        ];
    }
}
