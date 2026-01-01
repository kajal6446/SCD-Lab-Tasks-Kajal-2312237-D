<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'director',
        'release_year',
        'description',
        'genre',
        'rating',
        'duration',
        'poster_image',
        'trailer_url'
    ];

    // Validation rules (moved to controller or made as method)
   public static function rules()
{
    return [
        'title' => 'required|string|max:255',
        'director' => 'required|string|max:255',
        'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        'description' => 'required|string',
        'genre' => 'required|string|max:100',
        'rating' => 'required|numeric|min:0|max:10',
        'duration' => 'required|string|max:50',
        'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'trailer_url' => 'nullable|url'
    ];
}
}