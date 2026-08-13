<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        return [
            'question_id' => null,
            'option' => 'A, B, C, D',
            'answer' => '',
            'is_correct' => false,
            'is_active' => true,
        ];
    }
}