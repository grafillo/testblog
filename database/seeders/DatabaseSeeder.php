<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => '2023-06-14 08:41:15',
            'role' => 'user',
            'avatar' => 'user'
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('12345'),
            'email_verified_at' => '2023-06-14 08:41:15',
            'role' => 'admin',
            'avatar' => 'user'
        ]);


    }
}
