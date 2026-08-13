<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'subject_id' => null,

            'payload' => [
                'question' => '',
                'options' => [
                    'A' => '',
                    'B' => '',
                    'C' => '',
                    'D' => '',
                ],
                'correct_answer' => '',
            ],

            'score' => 1,

            'description' => 'Pilihlah salah satu jawaban yang paling tepat.',

            'is_active' => true,
        ];
    }

    public function question(
        int $subjectId,
        string $question,
        array $options,
        string $correctAnswer
    ): static {
        return $this->state(function () use (
            $subjectId,
            $question,
            $options,
            $correctAnswer
        ) {
            return [
                'subject_id' => $subjectId,

                'payload' => [
                    'question' => $question,

                    'options' => $options,

                    'correct_answer' => $correctAnswer,
                ],

                'score' => 1,

                'description' => 'Pilihlah salah satu jawaban yang paling tepat.',

                'is_active' => true,
            ];
        });
    }
}