<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalBooks = Book::count();
        $availableBooks = Book::whereDoesntHave('borrowings', function ($query) {
            $query->whereNull('returned_at');
        })->count();
        $totalUsers = User::count();
        $totalBorrowings = Borrowing::count();
        $userBorrowings = $user->borrowings()->count();
        $borrowedBooks = $user->borrowings()->with('book')->whereNull('returned_at')->get();
        $books = Book::whereDoesntHave('borrowings', function ($query) {
            $query->whereNull('returned_at');
        })->paginate(6);

        // Get popular categories
        $popularCategories = Book::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Get recent borrowings
        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->limit(5)
            ->get();

        // Get system status
        $systemStatus = [
            'total_disk_space' => disk_total_space(storage_path()),
            'total_books_size' => $this->calculateBooksStorageSize(),
            'active_borrowings' => Borrowing::whereNull('returned_at')->count()
        ];

        return view('dashboard', compact(
            'totalBooks',
            'availableBooks',
            'totalUsers',
            'totalBorrowings',
            'userBorrowings',
            'borrowedBooks',
            'books',
            'popularCategories',
            'recentBorrowings',
            'systemStatus'
        ));
    }

    private function calculateBooksStorageSize()
    {
        $totalSize = 0;
        $books = Book::all();
        
        foreach ($books as $book) {
            if ($book->cover_image) {
                $path = storage_path('app/public/' . $book->cover_image);
                if (file_exists($path)) {
                    $totalSize += filesize($path);
                }
            }
        }
        
        return $totalSize;
    }
} 