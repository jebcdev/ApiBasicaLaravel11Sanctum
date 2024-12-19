<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $userId = User::query()->pluck('id')->toArray();
        $categoryId = Category::query()->pluck('id')->toArray();
        $statusId = Status::query()->pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($userId),
            'category_id' => $this->faker->randomElement($categoryId),
            'status_id' => $this->faker->randomElement($statusId),
            'name' => 'Task: ' . $this->faker->unique()->word,
            'description' => $this->faker->sentence,
        ];
    }
}
