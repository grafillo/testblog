<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddpostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_addpost_unregistered_user(){

        $response = $this->get('/addpost');

        $response->assertRedirect('/register');

    }

    public function test_get_addpost_with_confirmed_email_user(){

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/addpost');

        $response->assertStatus(200);

    }

    public function test_get_addpost_with_dont_confirmed_email_user(){

        $user = User::factory()->create([
            'email_verified_at' => null]);

        $response = $this->actingAs($user)->get('/addpost');

        $response->assertRedirect('/verify-email');
    }


    public function test_post_addpost_registered_user(){

        $user = User::factory()->create();
        //$post = Post::factory()->create();

        $response = $this->actingAs($user)->post('/addpost',['title'=>'posttitle','message'=>'message',
            'vision'=>1]);

        $response->assertSessionHas('success', 'Ваша статья успешно добавлена!');


    }
    public function test_post_addpost_unregistered_user(){

        $post = Post::factory()->create();
        $response = $this->post('/addpost',['title'=>$post->title,'message'=>$post->title,
            'vision'=>1]);;

        $response->assertRedirect('/register');

    }
}
