@props(['book' => null])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $book ? 'Edit Book' : 'Add New Book' }}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $book ? route('books.update', $book) : route('books.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if($book)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $book?->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $book?->author) }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $book?->category) }}" required>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $book?->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($book?->cover_image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="Current cover" style="max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="file_path" class="form-label">Book File (PDF)</label>
                            <input type="file" class="form-control @error('file_path') is-invalid @enderror" id="file_path" name="file_path" accept=".pdf">
                            @error('file_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($book?->file_path)
                                <div class="mt-2">
                                    <small>Current file: {{ basename($book->file_path) }}</small>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ $book ? 'Update' : 'Add' }} Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 