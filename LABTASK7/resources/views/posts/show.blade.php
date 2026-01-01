@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <article>
            <h1>{{ $post->title }}</h1>
            
            <div class="mb-4 text-muted">
                By {{ $post->user->name }} | 
                {{ $post->created_at->format('M d, Y') }} |
                Categories: 
                @foreach($post->categories as $category)
                    <span class="badge bg-primary">{{ $category->name }}</span>
                @endforeach
            </div>
            
            <div class="post-content mb-5">
                {!! nl2br(e($post->content)) !!}
            </div>
            
            <div class="mb-4">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit Post</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure?')">Delete Post</button>
                </form>
            </div>
        </article>
        
        <section class="comments mt-5">
            <h3>Comments ({{ $post->comments->count() }})</h3>
            
            @foreach($post->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <div class="text-muted small">
                        By {{ $comment->user->name }} on 
                        {{ $comment->created_at->format('M d, Y \a\t h:i A') }}
                    </div>
                </div>
            </div>
            @endforeach
            
            @if($post->comments->isEmpty())
                <p class="text-muted">No comments yet.</p>
            @endif
        </section>
    </div>
</div>
@endsection