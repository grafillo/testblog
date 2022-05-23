<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'autor' => $this->faker->name,
            'title' => $this->faker->realText(100),
            'text' => $this->faker->text(300),
            'autor_id' => User::factory(),
            'vision' => 1,
        ];
    }
}
