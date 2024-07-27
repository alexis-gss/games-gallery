<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Visit>
 */
final class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'    => fake()->uuid(),
            'game_id' => fake()->randomElement(Game::pluck('id'))
                ?? Game::factory()->createQuietly(['published' => true]),
        ];
    }
}
