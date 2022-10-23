<?php

namespace App\Console\Commands;

use App\Jobs\PublishBlogPost;
use App\Models\User;
use App\Services\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutoImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto import blog posts from candidate test blog';

    /**
     * Execute the console command.
     *
     * @param  \App\Services\Post  $post
     * @return int
     */
    public function handle(Post $post)
    {
        try {
            // fetch blog post from blogging platform
            $response = Http::get(config('blogplatform.blog_feed'));

            // check if http call was successful
            if ($response->failed()) {
                Log::critical('Failed to fetch post from candidate test blog');

                return Command::FAILURE;
            }

            $response = $response->json();
            $posts = $response['articles'];

            // store imported blog post
            if (isset($posts)) {
                DB::transaction(function () use ($posts) {
                    $admin = User::where('email', 'elomena@square1.com')->pluck('id')->first();

                    foreach ($posts as $post) {
                        $data = $post + ['user_id' => $admin];

                        PublishBlogPost::dispatch($data)
                            ->delay(now()->addMinute());
                    }
                });
            }

            Log::info(count($posts).' post(s) imported successfully from blogging platform.');

            return Command::SUCCESS;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return Command::FAILURE;
        }
    }
}
