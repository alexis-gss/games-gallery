<?php

namespace Database\Factories;

use App\Enums\Users\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $published = fake()->boolean(75);
        return [
            'first_name'        => fake()->firstname(),
            'last_name'         => fake()->lastname(),
            'email'             => fake()->unique()->email(),
            'email_verified_at' => now(),
            'picture_alt'       => fake()->unique()->word,
            'picture_title'     => fake()->unique()->word,
            'password'          => fake()->password(),
            'remember_token'    => Str::random(10),
            'role'              => \collect(RoleEnum::toArray())->random()->value,
            'published'         => $published,
            'published_at'      => ($published) ? now() : null,
        ];
    }
}
