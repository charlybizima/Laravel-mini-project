<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create test user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // Create sample books
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
            Book::firstOrCreate(
                ['title' => $book['title']],
                $book
            );
        }
    }
}
