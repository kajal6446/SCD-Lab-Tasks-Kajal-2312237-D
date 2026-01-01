@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">View All Posts</a>
                    <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection