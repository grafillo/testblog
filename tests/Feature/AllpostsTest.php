<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllpostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_allposts_unregistered_user(){

        $post = Post::factory()->create();

        $response = $this->get('/allposts');

        $response->assertRedirect('/register');

    }

    public function test_get_allposts_registered_user(){

        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get('/allposts');

        $response->assertStatus(200);

    }

}
