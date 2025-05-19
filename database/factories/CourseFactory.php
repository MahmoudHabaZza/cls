<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(rand(6,12)),
            'description' => fake()->paragraphs(rand(3,9),true),
            'level' => (string) rand(0,2),
            'price' => fake()->randomFloat(2,250,3000),
            'sessions_count' => rand(8,100),
            'thumbnail' => 'https://picsum.photos/640/360?random='.rand(1,1000)
        ];
    }
}
