<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use App\Models\Post;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(SortRequest $request)
    {
        $posts = Post::with('user')
            ->orderBy(
                $request->get('sort_field') ?? 'publication_date',
                $request->get('sort_direction') ?? 'desc'
            )
            ->paginate(6);

        return Inertia::render('Welcome', [
            'posts' => $posts,
            'sort_fields' => Post::SORTABLE_FIELDS,
            'sort_directions'  => Post::SORT_DIRECTIONS
        ]);
    }
}
