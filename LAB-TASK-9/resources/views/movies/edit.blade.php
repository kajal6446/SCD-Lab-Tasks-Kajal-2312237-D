@extends('layouts.app')

@section('title', 'Edit Movie: ' . $movie->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="movie-detail-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-edit me-2"></i> Edit Movie
                    </h2>
                    <div>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-info me-2">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                        <a href="{{ route('movies.index') }}" class="btn btn-outline-light">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>

                <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Movie Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="director" class="form-label">Director *</label>
                                <input type="text" class="form-control @error('director') is-invalid @enderror" 
                                       id="director" name="director" value="{{ old('director', $movie->director) }}" required>
                                @error('director')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="release_year" class="form-label">Release Year *</label>
                                    <input type="number" class="form-control @error('release_year') is-invalid @enderror" 
                                           id="release_year" name="release_year" 
                                           value="{{ old('release_year', $movie->release_year) }}" 
                                           min="1900" max="{{ date('Y') + 5 }}" required>
                                    @error('release_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rating" class="form-label">Rating (0-10) *</label>
                                    <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" 
                                           id="rating" name="rating" 
                                           value="{{ old('rating', $movie->rating) }}" 
                                           min="0" max="10" required>
                                    @error('rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration *</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" name="duration" 
                                       value="{{ old('duration', $movie->duration) }}" required>
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre *</label>
                                <select class="form-select @error('genre') is-invalid @enderror" 
                                        id="genre" name="genre" required>
                                    <option value="">Select Genre</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre }}" 
                                            {{ old('genre', $movie->genre) == $genre ? 'selected' : '' }}>
                                            {{ $genre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="poster_image" class="form-label">Movie Poster</label>
                                <div class="mb-3">
                                   @if($movie->poster_image)
    <p class="text-muted small">Current Poster:</p>
    <img src="{{ asset($movie->poster_image) }}" 
         class="img-fluid rounded mb-2" style="max-height: 200px;">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" 
               id="remove_poster" name="remove_poster">
        <label class="form-check-label text-danger" for="remove_poster">
            Remove current poster
        </label>
    </div>
@endif
                                </div>
                                <input type="file" class="form-control @error('poster_image') is-invalid @enderror" 
                                       id="poster_image" name="poster_image" 
                                       accept="image/*" onchange="previewImage(this, 'imagePreview')">
                                @error('poster_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-3 text-center">
                                    <img id="imagePreview" src="https://via.placeholder.com/300x450?text=New+Poster+Preview" 
                                         class="img-fluid rounded" style="max-height: 200px; display: none;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="trailer_url" class="form-label">Trailer URL</label>
                                <input type="url" class="form-control @error('trailer_url') is-invalid @enderror" 
                                       id="trailer_url" name="trailer_url" 
                                       value="{{ old('trailer_url', $movie->trailer_url) }}">
                                @error('trailer_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" 
                                          rows="5" required>{{ old('description', $movie->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="reset" class="btn btn-outline-light me-md-2">
                            <i class="fas fa-redo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Movie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection