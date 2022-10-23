<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Post as BlogPost;

class Post
{
    public function publish($data)
    {
        BlogPost::create([
            'user_id' => auth()->user()->id,
            'title' => $data->title,
            'slug' => Str::slug($data->title),
            'description' => $data->description,
            'publication_date' => $data->publication_date
        ]);
    }
}
