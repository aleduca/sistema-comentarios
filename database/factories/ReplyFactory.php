<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'reply' => $this->faker->sentence,
      'comment_id' => $this->faker->numberBetween(1, 20),
      'user_id' => $this->faker->numberBetween(1, 20),
      'post_id' => $this->faker->numberBetween(1, 20),
    ];
  }
}
