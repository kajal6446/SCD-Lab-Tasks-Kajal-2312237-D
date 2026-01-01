@extends('layouts.app')

@section('title', 'All Movies')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title mb-4">Movie Collection</h1>
        <p class="lead mb-5">Explore our curated collection of amazing films from around the world</p>
        
        <!-- Search Form -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control search-box" 
                               placeholder="Search movies by title, director, genre..." 
                               value="{{ $search }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                        @if($search)
                            <a href="{{ route('movies.index') }}" class="btn btn-outline-light ms-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Action Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3">
            <i class="fas fa-video me-2"></i> 
            {{ $search ? 'Search Results' : 'All Movies' }}
            <span class="badge bg-primary ms-2">{{ $movies->total() }}</span>
        </h2>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Add New Movie
        </a>
    </div>

    <!-- Movies Grid -->
    @if($movies->count() > 0)
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-card h-100">
                        <div class="position-relative">
                            <img src="{{ $movie->poster_image ? asset($movie->poster_image) : 'https://via.placeholder.com/300x450?text=No+Poster' }}" 
     class="movie-poster" alt="{{ $movie->title }}">
                            <div class="rating-badge">
                                <i class="fas fa-star me-1"></i>{{ $movie->rating }}
                            </div>
                        </div>
                        <div class="p-3">
                            <h5 class="mb-2">{{ Str::limit($movie->title, 30) }}</h5>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-user me-1"></i> {{ $movie->director }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-secondary">
                                    <i class="fas fa-calendar me-1"></i> {{ $movie->release_year }}
                                </span>
                                <span class="badge bg-info">
                                    <i class="fas fa-clock me-1"></i> {{ $movie->duration }}
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="fas fa-eye me-1"></i> View
                                </a>
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-outline-warning flex-fill">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form id="delete-form-{{ $movie->id }}" action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $movie->id }})" class="btn btn-sm btn-outline-danger w-100">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $movies->links('pagination::bootstrap-5') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-film"></i>
            <h3 class="mb-3">No Movies Found</h3>
            <p class="text-muted mb-4">
                {{ $search ? 'No movies match your search criteria.' : 'Your movie collection is empty.' }}
            </p>
            <a href="{{ route('movies.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i> Add Your First Movie
            </a>
        </div>
    @endif
</div>
@endsection