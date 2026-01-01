<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    // List all movies with search functionality
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $movies = Movie::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('director', 'like', "%{$search}%")
                  ->orWhere('genre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        })->orderBy('created_at', 'desc')->paginate(8);
        
        return view('movies.index', compact('movies', 'search'));
    }

    // Show create form
    public function create()
    {
        $genres = [
            'Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy',
            'Horror', 'Mystery', 'Romance', 'Sci-Fi', 'Thriller',
            'Animation', 'Documentary', 'Crime', 'Family', 'Musical'
        ];
        
        return view('movies.create', compact('genres'));
    }

    // Store new movie
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Movie::rules());
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = $request->all();
        
        // Handle file upload - store in public/images/movies/
        if ($request->hasFile('poster_image')) {
            $image = $request->file('poster_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move to public/images/movies directory
            $image->move(public_path('images/movies'), $filename);
            $data['poster_image'] = 'images/movies/' . $filename;
        }
        
        Movie::create($data);
        
        return redirect()->route('movies.index')
            ->with('success', 'Movie added successfully!');
    }

    // Show single movie
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    // Show edit form
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = [
            'Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy',
            'Horror', 'Mystery', 'Romance', 'Sci-Fi', 'Thriller',
            'Animation', 'Documentary', 'Crime', 'Family', 'Musical'
        ];
        
        return view('movies.edit', compact('movie', 'genres'));
    }

    // Update movie
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        
        $rules = Movie::rules();
        $rules['poster_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('poster_image')) {
            // Delete old uploaded image if exists (but keep seeded images)
            if ($movie->poster_image && 
                strpos($movie->poster_image, 'images/movies/') !== false &&
                !file_exists(public_path($movie->poster_image))) {
                // This was a seeded image, don't delete it
            } else if ($movie->poster_image && file_exists(public_path($movie->poster_image))) {
                // This is an uploaded image, delete it
                unlink(public_path($movie->poster_image));
            }
            
            $image = $request->file('poster_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move to public/images/movies directory
            $image->move(public_path('images/movies'), $filename);
            $data['poster_image'] = 'images/movies/' . $filename;
        } else {
            unset($data['poster_image']);
        }
        
        $movie->update($data);
        
        return redirect()->route('movies.index')
            ->with('success', 'Movie updated successfully!');
    }

    // Delete movie
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        // Delete uploaded image if exists (but keep seeded images)
        if ($movie->poster_image && 
            strpos($movie->poster_image, 'images/movies/') !== false &&
            !file_exists(public_path($movie->poster_image))) {
            // This was a seeded image, don't delete it
        } else if ($movie->poster_image && file_exists(public_path($movie->poster_image))) {
            // This is an uploaded image, delete it
            unlink(public_path($movie->poster_image));
        }
        
        $movie->delete();
        
        return redirect()->route('movies.index')
            ->with('success', 'Movie deleted successfully!');
    }
}