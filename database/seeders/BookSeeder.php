<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'category' => 'Fiction',
                'description' => 'A story of decadence and excess.',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'category' => 'Science Fiction',
                'description' => 'A dystopian social science fiction novel.',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'category' => 'Fiction',
                'description' => 'A story of racial injustice and loss of innocence.',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'category' => 'Romance',
                'description' => 'A romantic novel of manners.',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'category' => 'Fantasy',
                'description' => 'A fantasy novel about the adventures of Bilbo Baggins.',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
} 