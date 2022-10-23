<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Post as BlogPost;

class Post
{
    public function publish($data)
    {
        $publication_date = Carbon::parse($data['publication_date'])
            ->toDateTimeString();

        BlogPost::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'],
            'publication_date' => $publication_date
        ]);
    }
}
