<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCopy;
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

        $book = Book::factory()->create([
            'title' => 'Life of Pi',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        BookCopy::factory()->count(1)->create([
            'book_id' => $book->id
        ]);

        $author = Author::factory()->create(['name' => 'Alexander Dumas']);

        $book = Book::factory()->create([
            'title' => 'The Three Musketeers',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        BookCopy::factory()->count(2)->create([
            'book_id' => $book->id
        ]);

        $genre = Genre::factory()->create(['name' => 'Detective and Mystery']);
        $author = Author::factory()->create(['name' => 'Sir Arthur Conan Doyle']);

        $book = Book::factory()->create([
            'title' => 'The Adventures of Sherlock Holmes',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        BookCopy::factory()->count(3)->create([
            'book_id' => $book->id
        ]);

        $author = Author::factory()->create(['name' => 'Michael Connelly']);

        $book = Book::factory()->create([
            'title' => 'The Night Fire',
            'genre_id' => $genre->id,
            'author_id' => $author->id
        ]);

        BookCopy::factory()->count(2)->create([
            'book_id' => $book->id
        ]);
    }
}
