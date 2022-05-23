<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_change_visible_unregistered_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->post('/update/'.$post->id, [
            'vision' => 1,
        ]);

        $response->assertRedirect('/register');
    }

    public function test_change_visible_registered_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['autor_id'=>$user->id]);

        $response = $this->actingAs($user)->post('/update/'.$post->id, [
            'vision' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_change_visible_registered_user_to_another_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post('/update/'.$post->id, [
            'vision' => 1,
        ]);

        $response->assertStatus(403);
    }

    public function test_change_visible_by_admin()
    {

        $admin = User::factory()->create(['role'=>'admin']);
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($admin)->post('/update/'.$post->id, [
            'vision' => 1,
        ]);

        $response->assertStatus(302);
    }
}
