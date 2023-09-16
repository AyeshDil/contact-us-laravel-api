<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
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
        $type = $this->faker->randomElement(['0', '1']);
        $status = $this->faker->randomElement(['0', '1', '2']);

        return [
            'user_id' => User::factory(),
            'message_id' => Message::factory(),
            'description' => $this->faker->text(300),
            'type' => $type,
            'status' => $status
        ];
    }
}
