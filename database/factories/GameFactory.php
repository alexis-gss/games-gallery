<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Game>
 */
final class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name      = fake()->unique()->word;
        $published = fake()->boolean(75);
        return [
            'folder_id'    => fake()->randomElement(Folder::pluck('id'))
                ?? Folder::factory()->createQuietly(['published' => true]),
            'name'         => $name,
            'slug'         => Str::of($name)->slug(),
            'picture'      => '',
            'published'    => $published,
            'published_at' => ($published) ? now() : null,
            'order'        => 1,
        ];
    }
}
