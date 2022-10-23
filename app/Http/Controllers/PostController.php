<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Jobs\PublishBlogPost;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Render new blog post form
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store new blog post
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $data = $request->validated() + ['user_id' => auth()->user()->id];

            PublishBlogPost::dispatch($data)
                ->onQueue('high-priority');

            request()->session()->flash('success', 'Great job! Your post is being published...');

            return Redirect::route('dashboard');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            request()->session()->flash('error', 'Oops something went wrong! Try again');

            return Redirect::back()->withInput();
        }
    }

    public function show(Post $post)
    {
        return Inertia::render('Post/Show', [
            'post' => $post->load('user'),
        ]);
    }
}
