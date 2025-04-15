<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $borrowings = auth()->user()->borrowings()->with('book')->latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    public function store(Request $request)
    {
        try {
            if (!$request->has('book_id')) {
                return redirect()->back()->with('error', 'Book ID is required.');
            }

            $book = Book::find($request->book_id);
            
            if (!$book) {
                return redirect()->back()->with('error', 'Book not found.');
            }

            if (!$book->isAvailable()) {
                return redirect()->back()->with('error', 'This book is currently not available.');
            }

            Borrowing::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'borrowed_at' => now(),
            ]);

            return redirect()->route('borrowings.index')->with('success', 'Book borrowed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while borrowing the book: ' . $e->getMessage());
        }
    }

    public function return(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $borrowing->update(['returned_at' => now()]);

        return redirect()->route('borrowings.index')->with('success', 'Book returned successfully.');
    }
} 