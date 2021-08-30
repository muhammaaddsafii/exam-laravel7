<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'slug', 'category_id', 'user_id', 'thumbnail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->thumbnail;            // cuman ditambahi prefix biar bisa diakses dimana saja 
    }
}
