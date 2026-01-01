<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
 

    // Display all posts
    public function index()
    {
        $posts = Post::with(['user', 'categories', 'comments'])
                    ->latest()
                    ->get();
        
        return view('posts.index', compact('posts'));
    }

    // Show form to create new post
public function create()
{
    $categories = Category::all();
    
    // Debug: Check if categories exist
    if ($categories->isEmpty()) {
        // Create some sample categories if none exist
        Category::create(['name' => 'Technology', 'slug' => 'technology']);
        Category::create(['name' => 'Lifestyle', 'slug' => 'lifestyle']);
        Category::create(['name' => 'Travel', 'slug' => 'travel']);
        $categories = Category::all();
    }
    
    // Debug output
    // dd($categories);
    
    return view('posts.create', compact('categories'));
}
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'required|array',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'), // CORRECTED: Use input() method
            'excerpt' => Str::limit(strip_tags($request->input('content')), 150), // CORRECTED
            'user_id' => Auth::id(),
        ]);

        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Display single post
    public function show(Post $post)
    {
        $post->load(['user', 'categories', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    // Show form to edit post
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Update post - CORRECTED
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'required|array',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'), // CORRECTED: Use input() method
            'excerpt' => Str::limit(strip_tags($request->input('content')), 150), // CORRECTED
        ]);

        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}