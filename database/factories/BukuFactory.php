<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Buku>
 */
class BukuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->sentence(3),
            'author' => fake()->name(),
            'tanggal_terbit' => fake()->date(),
            'category' => fake()->randomElement(['Fiction', 'Non-Fiction', 'Education', 'Technology']),
            'genre' => fake()->randomElement(['Novel', 'Fantasy', 'History', 'Programming']),
        ];
    }
}
