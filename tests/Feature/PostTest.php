<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_guest_can_see_blog_post()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post->slug));

        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page->has('post'));
    }

    public function test_guest_cannot_create_blog_post()
    {
        $response = $this->get(route('posts.create'));

        $response->assertRedirect('/login');
    }

    public function test_auth_user_can_view_create_blog_post_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get(route('posts.create'));

        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->url('/posts/create'));
    }

    public function test_auth_user_can_create_blog_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->post(route('posts.store'), [
                'title' => $this->faker->words(4, true),
                'slug' => $this->faker->slug(),
                'description' => $this->faker->realText(200),
                'publication_date' => now()->toDateTimeString(),
            ]);

        $response->assertStatus(302)
            ->assertSessionHas('success');

        // $response->assertRedirect(route('dashboard'))
        //     ->assertSessionHas('success');
    }
}
