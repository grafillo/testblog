<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditpostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_editpost_unregistered_user(){

        $post = Post::factory()->create();

        $response = $this->get('/editpost/'.$post->id);

        $response->assertRedirect('/register');

    }

    public function test_get_editpost_registered_user(){

        $user = User::factory()->create();
        $post = Post::factory()->create(['title'=>'test_get_editpost_registered_user',
            'autor_id'=>$user->id]);


        $response = $this->actingAs($user)->get('/editpost/'.$post->id);

        $response->assertViewHas('post', function (Post $post) {
            return $post->title === 'test_get_editpost_registered_user';
        });

    }

    public function test_get_editpost_registered_user_to_another_user(){

        $user = User::factory()->create();
        $post = Post::factory()->create();


        $response = $this->actingAs($user)->get('/editpost/'.$post->id);

        $response->assertStatus(403);

    }

    public function test_get_editpost_admin(){

        $user = User::factory()->create(['role'=>'admin']);
        $post = Post::factory()->create(['title'=>'test_get_editpost_admin']);


        $response = $this->actingAs($user)->get('/editpost/'.$post->id);

        $response->assertViewHas('post', function (Post $post) {
            return $post->title === 'test_get_editpost_admin';
        });

    }

    public function test_post_editpost_unregistered_user(){

        $post = Post::factory()->create();

        $response = $this->post('/editpost/'.$post->id);

        $response->assertRedirect('/register');

    }

    public function test_post_editpost_registered_user(){

        $user = User::factory()->create();
        $post = Post::factory()->create(['autor_id'=>$user->id]);


        $response = $this->actingAs($user)->post('/editpost/'.$post->id,['title'=>'title','message'=>'message',
            'vision'=>1]);


        $response->assertSessionHas('success', 'Запись успешно изменена!');

    }

    public function test_post_editpost_registered_user_to_another_user(){

        $user = User::factory()->create();
        $post = Post::factory()->create();


        $response = $this->actingAs($user)->post('/editpost/'.$post->id,['title'=>'title','message'=>'message',
            'vision'=>1]);

        $response->assertStatus(403);

    }

    public function test_post_editpost_admin(){

        $user = User::factory()->create(['role'=>'admin']);
        $post = Post::factory()->create();


        $response = $this->actingAs($user)->post('/editpost/'.$post->id,['title'=>'title','message'=>'message',
            'vision'=>1]);

        $response->assertSessionHas('success', 'Запись успешно изменена!');

    }


}
