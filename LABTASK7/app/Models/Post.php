<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'is_published', 'user_id'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Many-to-many relationship with Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Accessor for comment count
    public function getCommentCountAttribute()
    {
        return $this->comments()->count();
    }
}