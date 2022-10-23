<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SortRequest $request)
    {
        $posts = Post::query()
            ->orderBy(
                $request->get('sort_field') ?? 'publication_date',
                $request->get('sort_direction') ?? 'desc'
            )
            ->where('user_id', auth()->id())
            ->paginate(5);

        return Inertia::render('Dashboard', [
            'posts' => $posts,
            'sort_fields' => Post::SORTABLE_FIELDS,
            'sort_directions' => Post::SORT_DIRECTIONS,
        ]);
    }
}
