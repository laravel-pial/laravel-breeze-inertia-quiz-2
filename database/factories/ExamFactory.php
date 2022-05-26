<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Exam 1 auto',
            'duration' => '1',
            'mark' => '100',
            'has_negative_marking' => false,
            'negative_mark_rate' => '0.25',
            'no_of_quizes' => '2',
        ];
    }
}
