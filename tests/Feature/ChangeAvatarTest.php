<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ChangeAvatarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_avatar_can_be_uploaded_registered_user()
    {

        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post('/changeavatar/'.$user->id, [
            'image' => $file,
        ]);

        Storage::disk('local')->assertExists('/public/uploads/'.$file->hashName());
    }

    public function test_avatar_uploaded_unregistered_user()
    {

        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/changeavatar/'.$user->id, [
            'image' => $file,
        ]);

        $response->assertRedirect('/register');
    }

    public function test_avatar_uploaded_registered_user_to_another_user()
    {

        $user = User::factory()->create();
        $user1 = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post('/changeavatar/'.$user1->id, [
            'image' => $file,
        ]);

        $response->assertStatus(403);
    }

    public function test_avatar_uploaded_admin_to_another_user()
    {

        $admin = User::factory()->create(['role'=>'admin']);
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($admin)->post('/changeavatar/'.$user->id, [
            'image' => $file,
        ]);

        Storage::disk('local')->assertExists('/public/uploads/'.$file->hashName());
    }

}
