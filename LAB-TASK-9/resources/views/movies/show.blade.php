@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="movie-detail-card">
                <div class="row g-0">
                   <!-- Poster Column -->
<div class="col-md-4">
    <img src="{{ $movie->poster_image ? asset($movie->poster_image) : 'https://via.placeholder.com/400x600?text=No+Poster' }}" 
         class="img-fluid rounded-start" alt="{{ $movie->title }}" style="height: 100%; object-fit: cover;">
</div>
                    
                    <!-- Details Column -->
                    <div class="col-md-8">
                        <div class="p-4">
                            <!-- Header with Actions -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h1 class="h2 mb-2">{{ $movie->title }}</h1>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-primary fs-6 me-3">
                                            <i class="fas fa-star me-1"></i> {{ $movie->rating }}/10
                                        </span>
                                        <span class="badge bg-secondary fs-6">
                                            <i class="fas fa-calendar me-1"></i> {{ $movie->release_year }}
                                        </span>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $movie->id }})" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                    <form id="delete-form-{{ $movie->id }}" 
                                          action="{{ route('movies.destroy', $movie->id) }}" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>

                            <!-- Movie Info Grid -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <h5 class="text-primary">
                                        <i class="fas fa-user me-2"></i> Director
                                    </h5>
                                    <p class="fs-5">{{ $movie->director }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <h5 class="text-primary">
                                        <i class="fas fa-clock me-2"></i> Duration
                                    </h5>
                                    <p class="fs-5">{{ $movie->duration }}</p>
                                </div>
                                
                                <div class="col-12 mb-4">
                                    <h5 class="text-primary">
                                        <i class="fas fa-tags me-2"></i> Genre
                                    </h5>
                                    <div>
                                        <span class="genre-tag">{{ $movie->genre }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <h5 class="text-primary">
                                    <i class="fas fa-align-left me-2"></i> Synopsis
                                </h5>
                                <p class="fs-5">{{ $movie->description }}</p>
                            </div>

                            <!-- Trailer -->
                            @if($movie->trailer_url)
                            <div class="mb-4">
                                <h5 class="text-primary">
                                    <i class="fas fa-play-circle me-2"></i> Watch Trailer
                                </h5>
                                <a href="{{ $movie->trailer_url }}" target="_blank" class="btn btn-danger">
                                    <i class="fab fa-youtube me-2"></i> YouTube Trailer
                                </a>
                            </div>
                            @endif

                            <!-- Metadata -->
                            <div class="text-muted small">
                                <p class="mb-1">
                                    <i class="fas fa-calendar-plus me-1"></i> 
                                    Created: {{ $movie->created_at->format('M d, Y') }}
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-calendar-check me-1"></i> 
                                    Last Updated: {{ $movie->updated_at->format('M d, Y') }}
                                </p>
                            </div>

                            <!-- Back Button -->
                            <div class="mt-4">
                                <a href="{{ route('movies.index') }}" class="btn btn-outline-light">
                                    <i class="fas fa-arrow-left me-1"></i> Back to All Movies
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection