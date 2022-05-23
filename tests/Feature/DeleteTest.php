<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_delete_post_unregistered_user()
    {

        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->get('/delete/'.$post->id);

        $response->assertRedirect('/register');
    }

    public function test_delete_post_registered_user()
    {

        $user = User::factory()->create();
        $post = Post::factory()->create(['autor_id'=>$user->id]);

        $response = $this->actingAs($user)->get('/delete/'.$post->id);

        $response->assertStatus(302);
    }

    public function test_delete_post_by_admin()
    {
        $admin = User::factory()->create(['role'=>'admin']);
        $user = User::factory()->create();
        $post = Post::factory()->create(['autor_id'=>$user->id]);

        $response = $this->actingAs($admin)->get('/delete/'.$post->id);

        $response->assertStatus(302);
    }

    public function test_delete_post_user_to_another_user()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['autor_id'=>$user2->id]);

        $response = $this->actingAs($user1)->get('/delete/'.$post->id);

        $response->assertStatus(403);
    }
}
