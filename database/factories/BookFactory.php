<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'publisher' => $this->faker->company(),
            'author' => $this->faker->name(),
            'genre' => $this->faker->word(),
            'book_publication' => $this->faker->date(),
            'word_count' => $this->faker->numberBetween(5000, 100000),
            'price_usd' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}
