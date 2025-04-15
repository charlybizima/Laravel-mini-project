@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">All Books</h2>
                        @if(auth()->user()->isAdmin())
                            <div class="flex space-x-4">
                                <a href="{{ route('books.create') }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded">
                                    Add New Book
                                </a>
                                <a href="#" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded">
                                    Manage Categories
                                </a>
                            </div>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($books as $book)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                                <div class="w-full h-[150px] overflow-hidden">
                                    @if($book->cover_image)
                                        <img src="{{ Storage::url($book->cover_image) }}" 
                                             alt="{{ $book->title }}" 
                                             class="w-full h-full object-contain">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold mb-2">{{ $book->title }}</h4>
                                    <p class="text-gray-600 mb-2">by {{ $book->author }}</p>
                                    <p class="text-sm text-gray-500 mb-2">{{ $book->category }}</p>
                                    <div class="flex justify-between items-center mt-4">
                                        <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                                        @if($book->isAvailable())
                                            <form action="{{ route('borrowings.store') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-1 px-3 rounded text-sm">
                                                    Borrow
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-red-500 text-sm">Currently Borrowed</span>
                                        @endif
                                    </div>
                                    @if(auth()->user()->isAdmin())
                                        <div class="mt-4 flex space-x-2">
                                            <a href="{{ route('books.edit', $book) }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-1 px-3 rounded text-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-1 px-3 rounded text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">No books available at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 