@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h2>
                        <a href="{{ route('books.index') }}" class="text-blue-500 hover:text-blue-700">
                            Back to Books
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" 
                                     alt="{{ $book->title }}" 
                                     class="w-full h-[300px] object-contain rounded-lg bg-gray-50">
                            @else
                                <div class="w-full h-[300px] bg-gray-100 flex items-center justify-center rounded-lg">
                                    <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">Book Details</h3>
                                <div class="mt-2 space-y-2">
                                    <p><span class="font-medium">Author:</span> {{ $book->author }}</p>
                                    <p><span class="font-medium">Category:</span> {{ $book->category }}</p>
                                    <p><span class="font-medium">ISBN:</span> {{ $book->isbn }}</p>
                                    <p><span class="font-medium">Published Year:</span> {{ $book->published_year }}</p>
                                    <p><span class="font-medium">Status:</span> 
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $book->isAvailable() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $book->isAvailable() ? 'Available' : 'Currently Borrowed' }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                                <p class="mt-2 text-gray-600">{{ $book->description ?? 'No description available.' }}</p>
                            </div>

                            @if($book->isAvailable())
                                <form action="{{ route('borrowings.store') }}" method="POST" class="mt-6">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="">
                                        Borrow This Book
                                    </button>
                                </form>
                            @else
                                <div class="mt-6">
                                    <p class="text-red-500">This book is currently borrowed. Please check back later.</p>
                                </div>
                            @endif

                            @if(auth()->user()->isAdmin())
                                <div class="mt-6 flex space-x-4">
                                    <a href="{{ route('books.edit', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit Book
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete Book
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 