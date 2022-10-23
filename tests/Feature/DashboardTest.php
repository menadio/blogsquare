<?php

namespace Tests\Feature;

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_guest_user_cannot_see_dashboard()
    {
        $response = $this->get(route('dashboard'));

        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function test_auth_user_can_see_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->get(route('dashboard'));

        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                // ->where('user', $user)
                ->has('posts'));
    }
}
