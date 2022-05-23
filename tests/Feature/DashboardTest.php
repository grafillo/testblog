<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_dashboard_with_dont_autorised_user(){

        $response = $this->get('/dashboard');

        $response->assertRedirect('/register');
    }


    public function test_get_dashboard_with_autorised_user(){

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);

    }

}
