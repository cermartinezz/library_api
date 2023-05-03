<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = Genre::factory()->create();
        $author = Author::factory()->create();
        $title = fake()->sentence($nbWords = 6, $variableNbWords = true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'genre_id' => $genre->id,
            'author_id' => $author->id,
            'published_year' => fake()->year($max = 'now')
        ];
    }
}
