@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message and Navigation Buttons -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-12 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        Welcome, {{ auth()->user()->name }}!
                    </h1>
                    <p class="text-gray-600 mb-8">
                        You are logged in as {{ auth()->user()->isAdmin() ? 'an Administrator' : 'a Library Member' }}
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('books.index') }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105">
                            View Books
                        </a>
                        <a href="{{ route('borrowings.index') }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105">
                            View Borrowings
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('books.create') }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105">
                                Add New Book
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Admin Controls -->
            @if(auth()->user()->isAdmin())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Admin Controls</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="{{ route('books.create') }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded-lg text-center">
                                Add New Book
                            </a>
                            <a href="{{ route('books.index') }}" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded-lg text-center">
                                Manage Books
                            </a>
                            <a href="#" class="bg-gray-700 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded-lg text-center">
                                Manage Users
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Books</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $totalBooks }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Available Books</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $availableBooks }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Borrowings</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $totalBorrowings }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Popular Categories -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Popular Categories</h3>
                        <div class="space-y-4">
                            @foreach($popularCategories as $category)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">{{ $category->category }}</span>
                                    <span class="text-gray-900 font-semibold">{{ $category->total }} books</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">System Status</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Total Disk Space</span>
                                <span class="text-gray-900 font-semibold">{{ number_format($systemStatus['total_disk_space'] / 1024 / 1024 / 1024, 2) }} GB</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Books Storage Used</span>
                                <span class="text-gray-900 font-semibold">{{ number_format($systemStatus['total_books_size'] / 1024 / 1024, 2) }} MB</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Active Borrowings</span>
                                <span class="text-gray-900 font-semibold">{{ $systemStatus['active_borrowings'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentBorrowings as $borrowing)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $borrowing->returned_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $borrowing->returned_at ? 'Returned' : 'Borrowed' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $borrowing->created_at->format('M d, Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Currently Borrowed Books -->
            @if($borrowedBooks->isNotEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Your Currently Borrowed Books</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($borrowedBooks as $borrowing)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                                    <div class="w-full h-[150px] overflow-hidden">
                                        @if($borrowing->book->cover_image)
                                            <img src="{{ Storage::url($borrowing->book->cover_image) }}" 
                                                 alt="{{ $borrowing->book->title }}" 
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
                                        <h4 class="text-lg font-semibold mb-2">{{ $borrowing->book->title }}</h4>
                                        <p class="text-gray-600 mb-2">by {{ $borrowing->book->author }}</p>
                                        <p class="text-sm text-gray-500 mb-2">Borrowed on: {{ $borrowing->borrowed_at->format('M d, Y') }}</p>
                                        <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="mt-4">
                                            @csrf
                                            <button type="submit" class="w-full bg-gray-700 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded">
                                                Return Book
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Available Books -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Available Books</h3>
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
