<?php

namespace App\Filament\Test\Resources\Exams\Pages;

use App\Filament\Test\Resources\ExamResults\ExamResultResource;
use App\Filament\Test\Resources\Exams\ExamResource;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StartingExam extends Page
{
    protected static string $resource = ExamResource::class;

    protected string $view = 'filament.test.resources.exams.pages.starting-exam';

    public Exam $exam;

    public array $collections = [];

    // format: [question_id => answer_id]
    public array $answers = [];

    public function mount(Exam $exam): void
    {
        $this->exam = $exam;

        foreach ($exam->Subjects as $mapel) {
            $this->collections[] = [
                'id' => $mapel->id,
                'name' => $mapel->name,
                // hanya kolom yang perlu tampil; is_correct sengaja TIDAK dikirim ke browser
                'soals' => $mapel
                    ->questions()
                    ->where('is_active', true)
                    ->select(['id', 'payload'])
                    ->with([
                        'answers' => fn ($query) => $query
                            ->select(['id', 'question_id', 'text'])
                            ->inRandomOrder(),
                    ])
                    ->inRandomOrder()
                    ->limit($mapel->pivot->qty)
                    ->get()
                    ->toArray(),
            ];
        }
    }

    public function submit(): void
    {
        $student = Filament::auth()->user()?->student;

        if (! $student) {
            Notification::make()
                ->title('Akun Anda belum terhubung dengan data siswa.')
                ->danger()
                ->send();

            return;
        }

        $questionIds = collect($this->collections)
            ->flatMap(fn ($mapel) => collect($mapel['soals'])->pluck('id'));

        // Ambil ulang dari database (lengkap dengan kunci jawaban) untuk dinilai di server
        $questions = Question::query()
            ->with('answers')
            ->whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        $details = [];
        $totalQuestions = 0;
        $correctCount = 0;
        $totalWeight = 0;
        $earnedWeight = 0;

        foreach ($this->collections as $mapel) {
            foreach ($mapel['soals'] as $soal) {
                $question = $questions->get($soal['id']);

                if (! $question) {
                    continue;
                }

                $totalQuestions++;
                $weight = max((int) $question->score, 0);
                $totalWeight += $weight;

                $selected = $question->answers
                    ->firstWhere('id', (int) ($this->answers[$soal['id']] ?? 0));
                $correct = $question->answers->firstWhere('is_correct', true);

                $isCorrect = $selected && $correct && $selected->id === $correct->id;

                if ($isCorrect) {
                    $correctCount++;
                    $earnedWeight += $weight;
                }

                $details[] = [
                    'subject_id' => $mapel['id'],
                    'subject_name' => $mapel['name'],
                    'question_id' => $question->id,
                    'question_text' => $question->payload,
                    'answer_id' => $selected?->id,
                    'answer_text' => $selected ? Str::limit($selected->text, 255, '') : null,
                    'correct_answer_id' => $correct?->id,
                    'correct_answer_text' => $correct ? Str::limit($correct->text, 255, '') : null,
                    'is_correct' => (bool) $isCorrect,
                ];
            }
        }

        if ($totalQuestions === 0) {
            Notification::make()
                ->title('Tidak ada soal yang bisa dinilai.')
                ->danger()
                ->send();

            return;
        }

        $score = $totalWeight > 0
            ? round($earnedWeight / $totalWeight * 100, 2)
            : 0;

        $result = DB::transaction(function () use ($student, $details, $totalQuestions, $correctCount, $score) {
            $result = ExamResult::create([
                'exam_id' => $this->exam->id,
                'exam_title' => $this->exam->title,
                'student_id' => $student->id,
                'submitted_at' => now(),
                'total_questions' => $totalQuestions,
                'correct_count' => $correctCount,
                'wrong_count' => $totalQuestions - $correctCount,
                'score' => $score,
                'is_passed' => $score >= (float) $this->exam->threshold,
            ]);

            $result->details()->createMany($details);

            return $result;
        });

        $this->redirect(ExamResultResource::getUrl('view', ['record' => $result]));
    }
}