<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $genre = Genre::factory()->create(['name' => 'Action and Adventure']);
        $author = Author::factory()->create(['name' => 'Yann Martel']);

        Book::factory()->create([
            'title' => 'Life of Pi',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        $author = Author::factory()->create(['name' => 'Alexander Dumas']);

        Book::factory()->create([
            'title' => 'The Three Musketeers',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        $genre = Genre::factory()->create(['name' => 'Detective and Mystery']);
        $author = Author::factory()->create(['name' => 'Sir Arthur Conan Doyle']);

        Book::factory()->create([
            'title' => 'The Adventures of Sherlock Holmes',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        $author = Author::factory()->create(['name' => 'Michael Connelly']);

        Book::factory()->create([
            'title' => 'The Night Fire',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);
    }
}
