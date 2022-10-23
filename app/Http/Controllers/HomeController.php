<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(6);

        return Inertia::render('Welcome', [
            'posts' => $posts,
        ]);
    }
}
