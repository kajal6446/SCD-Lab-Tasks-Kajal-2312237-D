@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
        
        @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->excerpt }}</p>
                
                <div class="mb-2">
                    <strong>Author:</strong> {{ $post->user->name }} |
                    <strong>Categories:</strong> 
                    @foreach($post->categories as $category)
                        <span class="badge bg-secondary">{{ $category->name }}</span>
                    @endforeach
                    |
                    <strong>Comments:</strong> {{ $post->comment_count }}
                </div>
                
                <div class="btn-group">
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection