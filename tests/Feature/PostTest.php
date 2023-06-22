<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_postid_real()
    {

        $post = Post::factory()->create(['title'=>'test_get_postid_real','vision'=>'1']);

        $response = $this->get('/post/' . $post->id);

        $response->assertStatus(200);

        $response->assertViewHas('post', function (Post $post) {
            return $post->title === 'test_get_postid_real';
        });

    }

    public function test_get_postid_nonreal(){

        $response = $this->get('/post/'.'88881');

        $response->assertStatus(404);

    }

    public function test_get_postid_vision_0_by_unreguser(){

        $post = Post::factory()->create(['vision'=>'0']);

        $response = $this->get('/post/'.$post->id);

        $response->assertStatus(403);

    }
}
