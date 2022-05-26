<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Quiz 1 auto',
            'type' => 'mcq',
            'option_a' => 'dhaka',
            'option_b' => 'delhi',
            'option_c' => 'beijing',
            'answere' => 'option_a',
            'exam_id' => '1'
        ];
    }
}
