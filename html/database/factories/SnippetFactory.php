<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Snippet>
 */
class SnippetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::orderBy('id')->first();

        $title = fake()->words(5, true);

        $slug = Str::slug($title);


        return [
            'user_id' => $user->id,
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->sentences(2, true),
            'code' => fake()->sentences(1, true)
        ];
    }
}
