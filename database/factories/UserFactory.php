<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);
        $avatar_image = fake()->randomElement([
            'avatar_image/XcYXE7SOS3aFDTMQnpGoDY9yh6OydhA5CqfLpN0HFN1cu5ZugC.jpg',
            'avatar_image/Cmh39TDbZbfRnmlYwhEFWiHcdv6MryF69tVjTp5xde2guZJF2E.jpg'
        ]);

        return [
            'first_name' => fake()->name($gender),
            'last_name' => fake()->name($gender),
            'username' => fake()->unique()->userName(),
            'gender' => $gender,
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->freeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role_id' => mt_rand(1, 3),
            'avatar_image' => $avatar_image
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
