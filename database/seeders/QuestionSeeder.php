<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $this->seedMatematika();
            $this->seedBahasaIndonesia();
            $this->seedIpa();
        });
    }

    protected function insertQuestions(string $subjectName, array $questions): void
    {
        $subject = Subject::firstOrCreate(['name' => $subjectName]);

        $answerBuffer = [];

        foreach ($questions as $q) {
            $question = Question::create([
                'subject_id'  => $subject->id,
                'payload'     => $q['payload'],
                'score'       => 1,
                'description' => null,
                'is_active'   => true,
            ]);

            foreach ($q['answers'] as $a) {
                $answerBuffer[] = [
                    'question_id' => $question->id,
                    'option'      => $a['option'],
                    'text'        => $a['text'],
                    'is_correct'  => $a['is_correct'],
                    'is_active'   => true,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }

            if (count($answerBuffer) >= 100) {
                Answer::insert($answerBuffer);
                $answerBuffer = [];
            }
        }

        if (!empty($answerBuffer)) {
            Answer::insert($answerBuffer);
        }

        $this->command->info("Berhasil insert " . count($questions) . " soal untuk {$subjectName}");
    }

    /**
     * ============================
     * MATEMATIKA (150 soal)
     * ============================
     */
    protected function seedMatematika(): void
    {
        $questions = [
            [
                'payload' => 'Hasil dari 25 + 37 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '62', 'is_correct' => true],
                    ['option' => 'B', 'text' => '60', 'is_correct' => false],
                    ['option' => 'C', 'text' => '52', 'is_correct' => false],
                    ['option' => 'D', 'text' => '63', 'is_correct' => false],
                    ['option' => 'E', 'text' => '72', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari 84 - 29 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '56', 'is_correct' => false],
                    ['option' => 'B', 'text' => '55', 'is_correct' => true],
                    ['option' => 'C', 'text' => '45', 'is_correct' => false],
                    ['option' => 'D', 'text' => '54', 'is_correct' => false],
                    ['option' => 'E', 'text' => '65', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari 12 × 8 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '108', 'is_correct' => false],
                    ['option' => 'B', 'text' => '112', 'is_correct' => false],
                    ['option' => 'C', 'text' => '86', 'is_correct' => false],
                    ['option' => 'D', 'text' => '92', 'is_correct' => false],
                    ['option' => 'E', 'text' => '96', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil dari 144 ÷ 12 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '11', 'is_correct' => false],
                    ['option' => 'B', 'text' => '12', 'is_correct' => true],
                    ['option' => 'C', 'text' => '10', 'is_correct' => false],
                    ['option' => 'D', 'text' => '16', 'is_correct' => false],
                    ['option' => 'E', 'text' => '14', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari 15 + 6 × 2 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '21', 'is_correct' => false],
                    ['option' => 'B', 'text' => '42', 'is_correct' => false],
                    ['option' => 'C', 'text' => '27', 'is_correct' => true],
                    ['option' => 'D', 'text' => '30', 'is_correct' => false],
                    ['option' => 'E', 'text' => '36', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari (15 + 6) × 2 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '42', 'is_correct' => true],
                    ['option' => 'B', 'text' => '32', 'is_correct' => false],
                    ['option' => 'C', 'text' => '48', 'is_correct' => false],
                    ['option' => 'D', 'text' => '36', 'is_correct' => false],
                    ['option' => 'E', 'text' => '27', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai x pada 2x + 1 = 13 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '6', 'is_correct' => true],
                    ['option' => 'C', 'text' => '7', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '5', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai x pada 2x + 2 = 6 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '3', 'is_correct' => false],
                    ['option' => 'C', 'text' => '2', 'is_correct' => true],
                    ['option' => 'D', 'text' => '1', 'is_correct' => false],
                    ['option' => 'E', 'text' => '0', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai x pada 3x - 5 = 16 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '7', 'is_correct' => true],
                    ['option' => 'C', 'text' => '6', 'is_correct' => false],
                    ['option' => 'D', 'text' => '9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '8', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai x pada 4x + 4 = 20 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '4', 'is_correct' => true],
                    ['option' => 'C', 'text' => '3', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '6', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai x pada 5x - 10 = 15 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '6', 'is_correct' => false],
                    ['option' => 'B', 'text' => '3', 'is_correct' => false],
                    ['option' => 'C', 'text' => '7', 'is_correct' => false],
                    ['option' => 'D', 'text' => '4', 'is_correct' => false],
                    ['option' => 'E', 'text' => '5', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil dari 3² adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '9', 'is_correct' => true],
                    ['option' => 'B', 'text' => '16', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '6', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari 5² adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '25', 'is_correct' => true],
                    ['option' => 'B', 'text' => '30', 'is_correct' => false],
                    ['option' => 'C', 'text' => '10', 'is_correct' => false],
                    ['option' => 'D', 'text' => '15', 'is_correct' => false],
                    ['option' => 'E', 'text' => '20', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari √81 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '9', 'is_correct' => true],
                    ['option' => 'B', 'text' => '12', 'is_correct' => false],
                    ['option' => 'C', 'text' => '7', 'is_correct' => false],
                    ['option' => 'D', 'text' => '10', 'is_correct' => false],
                    ['option' => 'E', 'text' => '8', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari √144 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '13', 'is_correct' => false],
                    ['option' => 'B', 'text' => '14', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => true],
                    ['option' => 'D', 'text' => '10', 'is_correct' => false],
                    ['option' => 'E', 'text' => '11', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'FPB dari 12 dan 18 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '2', 'is_correct' => false],
                    ['option' => 'B', 'text' => '4', 'is_correct' => false],
                    ['option' => 'C', 'text' => '9', 'is_correct' => false],
                    ['option' => 'D', 'text' => '6', 'is_correct' => true],
                    ['option' => 'E', 'text' => '3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'KPK dari 6 dan 8 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '24', 'is_correct' => true],
                    ['option' => 'B', 'text' => '36', 'is_correct' => false],
                    ['option' => 'C', 'text' => '18', 'is_correct' => false],
                    ['option' => 'D', 'text' => '48', 'is_correct' => false],
                    ['option' => 'E', 'text' => '12', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'FPB dari 24 dan 36 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '6', 'is_correct' => false],
                    ['option' => 'B', 'text' => '10', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => true],
                    ['option' => 'D', 'text' => '18', 'is_correct' => false],
                    ['option' => 'E', 'text' => '8', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'KPK dari 9 dan 12 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '48', 'is_correct' => false],
                    ['option' => 'B', 'text' => '36', 'is_correct' => true],
                    ['option' => 'C', 'text' => '27', 'is_correct' => false],
                    ['option' => 'D', 'text' => '18', 'is_correct' => false],
                    ['option' => 'E', 'text' => '24', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bilangan prima terkecil adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1', 'is_correct' => false],
                    ['option' => 'B', 'text' => '4', 'is_correct' => false],
                    ['option' => 'C', 'text' => '5', 'is_correct' => false],
                    ['option' => 'D', 'text' => '2', 'is_correct' => true],
                    ['option' => 'E', 'text' => '3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bilangan prima setelah 7 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '13', 'is_correct' => false],
                    ['option' => 'B', 'text' => '9', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => false],
                    ['option' => 'D', 'text' => '11', 'is_correct' => true],
                    ['option' => 'E', 'text' => '10', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pecahan yang senilai dengan 1/2 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4/10', 'is_correct' => false],
                    ['option' => 'B', 'text' => '3/5', 'is_correct' => false],
                    ['option' => 'C', 'text' => '2/4', 'is_correct' => true],
                    ['option' => 'D', 'text' => '2/5', 'is_correct' => false],
                    ['option' => 'E', 'text' => '1/3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pecahan yang senilai dengan 3/4 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '6/8', 'is_correct' => true],
                    ['option' => 'B', 'text' => '5/8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3/8', 'is_correct' => false],
                    ['option' => 'D', 'text' => '4/6', 'is_correct' => false],
                    ['option' => 'E', 'text' => '8/12', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 1/2 + 1/4 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1/4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5/6', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3/4', 'is_correct' => true],
                    ['option' => 'D', 'text' => '2/4', 'is_correct' => false],
                    ['option' => 'E', 'text' => '4/5', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 2/3 + 1/3 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1/3', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5/3', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1', 'is_correct' => true],
                    ['option' => 'D', 'text' => '4/3', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2/3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 3/4 - 1/4 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1/4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '2/4', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1/2', 'is_correct' => true],
                    ['option' => 'D', 'text' => '1', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3/4', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 5/6 - 1/3 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1/2', 'is_correct' => true],
                    ['option' => 'B', 'text' => '3/4', 'is_correct' => false],
                    ['option' => 'C', 'text' => '2/3', 'is_correct' => false],
                    ['option' => 'D', 'text' => '5/9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '1/3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 2/5 × 5/6 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '2/3', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5/11', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3/5', 'is_correct' => false],
                    ['option' => 'D', 'text' => '1/5', 'is_correct' => false],
                    ['option' => 'E', 'text' => '1/3', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil 3/4 ÷ 1/2 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '3/2', 'is_correct' => true],
                    ['option' => 'B', 'text' => '2/3', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3/4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '1/2', 'is_correct' => false],
                    ['option' => 'E', 'text' => '4/3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '0,75 jika diubah menjadi pecahan adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '3/4', 'is_correct' => true],
                    ['option' => 'B', 'text' => '2/5', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1/4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '7/10', 'is_correct' => false],
                    ['option' => 'E', 'text' => '4/5', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '25% dalam bentuk pecahan adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1/5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '2/5', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3/4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '1/4', 'is_correct' => true],
                    ['option' => 'E', 'text' => '1/2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '0,5 dalam bentuk persen adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '25%', 'is_correct' => false],
                    ['option' => 'B', 'text' => '50%', 'is_correct' => true],
                    ['option' => 'C', 'text' => '75%', 'is_correct' => false],
                    ['option' => 'D', 'text' => '100%', 'is_correct' => false],
                    ['option' => 'E', 'text' => '5%', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '3/5 dalam bentuk desimal adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '0,75', 'is_correct' => false],
                    ['option' => 'B', 'text' => '0,5', 'is_correct' => false],
                    ['option' => 'C', 'text' => '0,6', 'is_correct' => true],
                    ['option' => 'D', 'text' => '0,8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '0,3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '20% dari 150 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '35', 'is_correct' => false],
                    ['option' => 'B', 'text' => '25', 'is_correct' => false],
                    ['option' => 'C', 'text' => '40', 'is_correct' => false],
                    ['option' => 'D', 'text' => '30', 'is_correct' => true],
                    ['option' => 'E', 'text' => '20', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '15% dari 200 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '25', 'is_correct' => false],
                    ['option' => 'B', 'text' => '30', 'is_correct' => true],
                    ['option' => 'C', 'text' => '20', 'is_correct' => false],
                    ['option' => 'D', 'text' => '35', 'is_correct' => false],
                    ['option' => 'E', 'text' => '45', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Harga Rp100.000 mendapat diskon 20%. Harga setelah diskon adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Rp80.000', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'Rp90.000', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Rp85.000', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Rp75.000', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Rp70.000', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perbandingan 2 : 3 setara dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => '3 : 5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '8 : 10', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4 : 5', 'is_correct' => false],
                    ['option' => 'D', 'text' => '4 : 6', 'is_correct' => true],
                    ['option' => 'E', 'text' => '6 : 8', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 3 buku seharga Rp18.000, harga 1 buku adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Rp8.000', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Rp6.000', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'Rp7.000', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Rp4.000', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Rp5.000', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 5 pensil seharga Rp10.000, harga 8 pensil adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Rp18.000', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Rp16.000', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'Rp14.000', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Rp12.000', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Rp20.000', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rata-rata 6, 8, 10 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '9', 'is_correct' => false],
                    ['option' => 'B', 'text' => '10', 'is_correct' => false],
                    ['option' => 'C', 'text' => '8', 'is_correct' => true],
                    ['option' => 'D', 'text' => '6', 'is_correct' => false],
                    ['option' => 'E', 'text' => '7', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rata-rata 5, 7, 9, 11 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '8', 'is_correct' => true],
                    ['option' => 'B', 'text' => '10', 'is_correct' => false],
                    ['option' => 'C', 'text' => '9', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8.5', 'is_correct' => false],
                    ['option' => 'E', 'text' => '7', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Median dari 3, 5, 7, 9, 11 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '9', 'is_correct' => false],
                    ['option' => 'B', 'text' => '6', 'is_correct' => false],
                    ['option' => 'C', 'text' => '5', 'is_correct' => false],
                    ['option' => 'D', 'text' => '7', 'is_correct' => true],
                    ['option' => 'E', 'text' => '8', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Modus dari 2, 3, 3, 4, 5 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '3', 'is_correct' => true],
                    ['option' => 'B', 'text' => '2', 'is_correct' => false],
                    ['option' => 'C', 'text' => '6', 'is_correct' => false],
                    ['option' => 'D', 'text' => '4', 'is_correct' => false],
                    ['option' => 'E', 'text' => '5', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jangkauan data 4, 7, 9, 12 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '9', 'is_correct' => false],
                    ['option' => 'C', 'text' => '6', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => true],
                    ['option' => 'E', 'text' => '7', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Keliling persegi dengan sisi 8 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '32 cm', 'is_correct' => true],
                    ['option' => 'B', 'text' => '16 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '64 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '24 cm', 'is_correct' => false],
                    ['option' => 'E', 'text' => '40 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas persegi dengan sisi 8 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '16 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '32 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '48 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '72 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '64 cm²', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Keliling persegi panjang panjang 10 cm dan lebar 5 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '50 cm', 'is_correct' => false],
                    ['option' => 'B', 'text' => '15 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '25 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '30 cm', 'is_correct' => true],
                    ['option' => 'E', 'text' => '20 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas persegi panjang panjang 10 cm dan lebar 5 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '30 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '50 cm²', 'is_correct' => true],
                    ['option' => 'C', 'text' => '25 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '40 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '60 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas segitiga dengan alas 10 cm dan tinggi 6 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '30 cm²', 'is_correct' => true],
                    ['option' => 'B', 'text' => '20 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '40 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '50 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '60 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas jajargenjang dengan alas 12 cm dan tinggi 5 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '70 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '40 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '30 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '50 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '60 cm²', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Luas trapesium dengan sisi sejajar 8 cm dan 12 cm serta tinggi 5 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '40 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '50 cm²', 'is_correct' => true],
                    ['option' => 'C', 'text' => '55 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '60 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '45 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Keliling segitiga dengan sisi 6 cm, 8 cm, dan 10 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '24 cm', 'is_correct' => true],
                    ['option' => 'B', 'text' => '26 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '30 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '22 cm', 'is_correct' => false],
                    ['option' => 'E', 'text' => '20 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Volume kubus dengan rusuk 4 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '16 cm³', 'is_correct' => false],
                    ['option' => 'B', 'text' => '64 cm³', 'is_correct' => true],
                    ['option' => 'C', 'text' => '80 cm³', 'is_correct' => false],
                    ['option' => 'D', 'text' => '48 cm³', 'is_correct' => false],
                    ['option' => 'E', 'text' => '32 cm³', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Volume balok 10 cm × 5 cm × 4 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '250 cm³', 'is_correct' => false],
                    ['option' => 'B', 'text' => '150 cm³', 'is_correct' => false],
                    ['option' => 'C', 'text' => '100 cm³', 'is_correct' => false],
                    ['option' => 'D', 'text' => '200 cm³', 'is_correct' => true],
                    ['option' => 'E', 'text' => '180 cm³', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas permukaan kubus dengan rusuk 5 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '200 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '175 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '100 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '150 cm²', 'is_correct' => true],
                    ['option' => 'E', 'text' => '125 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Volume tabung dengan r=7 cm, t=10 cm, π=22/7 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '980 cm³', 'is_correct' => false],
                    ['option' => 'B', 'text' => '1540 cm³', 'is_correct' => true],
                    ['option' => 'C', 'text' => '770 cm³', 'is_correct' => false],
                    ['option' => 'D', 'text' => '1400 cm³', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3080 cm³', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Keliling lingkaran dengan r=7 cm dan π=22/7 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '44 cm', 'is_correct' => true],
                    ['option' => 'B', 'text' => '88 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '49 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '33 cm', 'is_correct' => false],
                    ['option' => 'E', 'text' => '22 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas lingkaran dengan r=7 cm dan π=22/7 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '77 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '44 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '308 cm²', 'is_correct' => false],
                    ['option' => 'D', 'text' => '154 cm²', 'is_correct' => true],
                    ['option' => 'E', 'text' => '144 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan panjang 1 km sama dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => '1000 m', 'is_correct' => true],
                    ['option' => 'B', 'text' => '100 m', 'is_correct' => false],
                    ['option' => 'C', 'text' => '500 m', 'is_correct' => false],
                    ['option' => 'D', 'text' => '10 m', 'is_correct' => false],
                    ['option' => 'E', 'text' => '10.000 m', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan panjang 1 m sama dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => '10 cm', 'is_correct' => false],
                    ['option' => 'B', 'text' => '50 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '10.000 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '100 cm', 'is_correct' => true],
                    ['option' => 'E', 'text' => '1000 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '1 kg sama dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => '10.000 gram', 'is_correct' => false],
                    ['option' => 'B', 'text' => '1000 gram', 'is_correct' => true],
                    ['option' => 'C', 'text' => '1500 gram', 'is_correct' => false],
                    ['option' => 'D', 'text' => '500 gram', 'is_correct' => false],
                    ['option' => 'E', 'text' => '100 gram', 'is_correct' => false],
                ],
            ],
            [
                'payload' => '1 liter sama dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => '100 mL', 'is_correct' => false],
                    ['option' => 'B', 'text' => '500 mL', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1000 mL', 'is_correct' => true],
                    ['option' => 'D', 'text' => '1500 mL', 'is_correct' => false],
                    ['option' => 'E', 'text' => '10.000 mL', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bilangan bulat positif terkecil adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '0', 'is_correct' => false],
                    ['option' => 'B', 'text' => '2', 'is_correct' => false],
                    ['option' => 'C', 'text' => '-2', 'is_correct' => false],
                    ['option' => 'D', 'text' => '-1', 'is_correct' => false],
                    ['option' => 'E', 'text' => '1', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Lawan dari -8 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '8', 'is_correct' => true],
                    ['option' => 'B', 'text' => '-8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '16', 'is_correct' => false],
                    ['option' => 'D', 'text' => '0', 'is_correct' => false],
                    ['option' => 'E', 'text' => '1', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil -7 + 12 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5', 'is_correct' => true],
                    ['option' => 'C', 'text' => '3', 'is_correct' => false],
                    ['option' => 'D', 'text' => '19', 'is_correct' => false],
                    ['option' => 'E', 'text' => '6', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 8 - 13 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '-4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '-5', 'is_correct' => true],
                    ['option' => 'C', 'text' => '5', 'is_correct' => false],
                    ['option' => 'D', 'text' => '-21', 'is_correct' => false],
                    ['option' => 'E', 'text' => '4', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil -6 × 4 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '10', 'is_correct' => false],
                    ['option' => 'B', 'text' => '24', 'is_correct' => false],
                    ['option' => 'C', 'text' => '-24', 'is_correct' => true],
                    ['option' => 'D', 'text' => '-10', 'is_correct' => false],
                    ['option' => 'E', 'text' => '30', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil -36 ÷ 6 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '-6', 'is_correct' => true],
                    ['option' => 'B', 'text' => '-12', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => false],
                    ['option' => 'D', 'text' => '-4', 'is_correct' => false],
                    ['option' => 'E', 'text' => '6', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 2³ adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '16', 'is_correct' => false],
                    ['option' => 'B', 'text' => '6', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => false],
                    ['option' => 'D', 'text' => '9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '8', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil 10² adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '50', 'is_correct' => false],
                    ['option' => 'B', 'text' => '20', 'is_correct' => false],
                    ['option' => 'C', 'text' => '100', 'is_correct' => true],
                    ['option' => 'D', 'text' => '110', 'is_correct' => false],
                    ['option' => 'E', 'text' => '120', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 2⁴ × 2² adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '64', 'is_correct' => true],
                    ['option' => 'B', 'text' => '32', 'is_correct' => false],
                    ['option' => 'C', 'text' => '16', 'is_correct' => false],
                    ['option' => 'D', 'text' => '48', 'is_correct' => false],
                    ['option' => 'E', 'text' => '128', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bentuk sederhana dari 3x + 2x adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5x', 'is_correct' => true],
                    ['option' => 'B', 'text' => '6x', 'is_correct' => false],
                    ['option' => 'C', 'text' => '5', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'x²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3x²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bentuk sederhana dari 7a - 3a adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4a', 'is_correct' => true],
                    ['option' => 'B', 'text' => '10a', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'a⁴', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3a', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil dari 2(x + 3) adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'x + 6', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'x + 3', 'is_correct' => false],
                    ['option' => 'C', 'text' => '2x + 6', 'is_correct' => true],
                    ['option' => 'D', 'text' => '2x + 9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2x + 3', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika x=4, nilai 3x+2 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '12', 'is_correct' => false],
                    ['option' => 'B', 'text' => '14', 'is_correct' => true],
                    ['option' => 'C', 'text' => '10', 'is_correct' => false],
                    ['option' => 'D', 'text' => '18', 'is_correct' => false],
                    ['option' => 'E', 'text' => '16', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika a=5, nilai 2a-3 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '8', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5', 'is_correct' => false],
                    ['option' => 'C', 'text' => '13', 'is_correct' => false],
                    ['option' => 'D', 'text' => '7', 'is_correct' => true],
                    ['option' => 'E', 'text' => '10', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Persamaan x + 7 = 15 memiliki x = ...',
                'answers' => [
                    ['option' => 'A', 'text' => '7', 'is_correct' => false],
                    ['option' => 'B', 'text' => '6', 'is_correct' => false],
                    ['option' => 'C', 'text' => '10', 'is_correct' => false],
                    ['option' => 'D', 'text' => '9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '8', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Persamaan x - 9 = 4 memiliki x = ...',
                'answers' => [
                    ['option' => 'A', 'text' => '9', 'is_correct' => false],
                    ['option' => 'B', 'text' => '14', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => false],
                    ['option' => 'D', 'text' => '5', 'is_correct' => false],
                    ['option' => 'E', 'text' => '13', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Persamaan 3x = 21 memiliki x = ...',
                'answers' => [
                    ['option' => 'A', 'text' => '10', 'is_correct' => false],
                    ['option' => 'B', 'text' => '8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '6', 'is_correct' => false],
                    ['option' => 'D', 'text' => '9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '7', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Persamaan 5x = 45 memiliki x = ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '9', 'is_correct' => true],
                    ['option' => 'C', 'text' => '8', 'is_correct' => false],
                    ['option' => 'D', 'text' => '10', 'is_correct' => false],
                    ['option' => 'E', 'text' => '12', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Koordinat titik yang berada 3 satuan ke kanan dan 2 satuan ke atas dari titik asal adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '(3,2)', 'is_correct' => true],
                    ['option' => 'B', 'text' => '(-2,-3)', 'is_correct' => false],
                    ['option' => 'C', 'text' => '(2,3)', 'is_correct' => false],
                    ['option' => 'D', 'text' => '(3,-2)', 'is_correct' => false],
                    ['option' => 'E', 'text' => '(-3,2)', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sumbu mendatar pada koordinat disebut sumbu ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Y', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'A', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Z', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'X', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'B', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sumbu tegak pada koordinat disebut sumbu ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'B', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'A', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Y', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Z', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'X', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Titik (0,0) disebut titik ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'puncak', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tengah', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pusat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'asal', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'sudut', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sudut 90° disebut sudut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'siku-siku', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'lurus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tumpul', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'lancip', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'refleks', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sudut kurang dari 90° disebut sudut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tumpul', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'lurus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'siku-siku', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'refleks', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'lancip', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Sudut lebih dari 90° dan kurang dari 180° disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tumpul', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'lurus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'lancip', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'penuh', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'siku-siku', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sudut 180° disebut sudut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lurus', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'siku-siku', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tumpul', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'refleks', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'lancip', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jumlah sudut dalam segitiga adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '360°', 'is_correct' => false],
                    ['option' => 'B', 'text' => '270°', 'is_correct' => false],
                    ['option' => 'C', 'text' => '180°', 'is_correct' => true],
                    ['option' => 'D', 'text' => '90°', 'is_correct' => false],
                    ['option' => 'E', 'text' => '120°', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jumlah sudut dalam segiempat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '180°', 'is_correct' => false],
                    ['option' => 'B', 'text' => '720°', 'is_correct' => false],
                    ['option' => 'C', 'text' => '270°', 'is_correct' => false],
                    ['option' => 'D', 'text' => '540°', 'is_correct' => false],
                    ['option' => 'E', 'text' => '360°', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Segitiga dengan tiga sisi sama panjang disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'siku-siku', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tumpul', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sama sisi', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'sama kaki', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sembarang', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Segitiga dengan dua sisi sama panjang disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lancip', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sama kaki', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'sama sisi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sembarang', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'siku-siku', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Segitiga dengan satu sudut 90° disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sama sisi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'siku-siku', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'lancip', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sama kaki', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tumpul', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bangun dengan empat sisi sama panjang dan empat sudut siku-siku adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'layang-layang', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'jajargenjang', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'persegi panjang', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'trapesium', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'persegi', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Bangun dengan dua pasang sisi berhadapan sama panjang dan empat sudut siku-siku adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'persegi panjang', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'layang-layang', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'persegi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'trapesium', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'belah ketupat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bangun dengan satu pasang sisi sejajar disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lingkaran', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'trapesium', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'belah ketupat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'segitiga', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'persegi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bangun yang semua titik pada tepinya berjarak sama dari pusat disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lingkaran', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'persegi panjang', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'segitiga', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'trapesium', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'persegi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bilangan 0 termasuk bilangan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cacah', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'prima', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'negatif', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ganjil', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'irasional', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bilangan 2, 4, 6, 8 termasuk bilangan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'prima', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'pecahan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ganjil', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'negatif', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'genap', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Bilangan 1, 3, 5, 7 termasuk bilangan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'negatif', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'genap', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'prima semuanya', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ganjil', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'pecahan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 7 × 9 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '63', 'is_correct' => true],
                    ['option' => 'B', 'text' => '72', 'is_correct' => false],
                    ['option' => 'C', 'text' => '81', 'is_correct' => false],
                    ['option' => 'D', 'text' => '56', 'is_correct' => false],
                    ['option' => 'E', 'text' => '62', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 13 × 7 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '91', 'is_correct' => true],
                    ['option' => 'B', 'text' => '97', 'is_correct' => false],
                    ['option' => 'C', 'text' => '87', 'is_correct' => false],
                    ['option' => 'D', 'text' => '101', 'is_correct' => false],
                    ['option' => 'E', 'text' => '81', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 225 ÷ 15 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '20', 'is_correct' => false],
                    ['option' => 'B', 'text' => '18', 'is_correct' => false],
                    ['option' => 'C', 'text' => '12', 'is_correct' => false],
                    ['option' => 'D', 'text' => '15', 'is_correct' => true],
                    ['option' => 'E', 'text' => '10', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 360 ÷ 12 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '40', 'is_correct' => false],
                    ['option' => 'B', 'text' => '20', 'is_correct' => false],
                    ['option' => 'C', 'text' => '30', 'is_correct' => true],
                    ['option' => 'D', 'text' => '35', 'is_correct' => false],
                    ['option' => 'E', 'text' => '25', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 125 + 375 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '600', 'is_correct' => false],
                    ['option' => 'B', 'text' => '550', 'is_correct' => false],
                    ['option' => 'C', 'text' => '625', 'is_correct' => false],
                    ['option' => 'D', 'text' => '500', 'is_correct' => true],
                    ['option' => 'E', 'text' => '450', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 1000 - 275 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '775', 'is_correct' => false],
                    ['option' => 'B', 'text' => '700', 'is_correct' => false],
                    ['option' => 'C', 'text' => '725', 'is_correct' => true],
                    ['option' => 'D', 'text' => '625', 'is_correct' => false],
                    ['option' => 'E', 'text' => '750', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 2,5 + 1,75 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4,25', 'is_correct' => true],
                    ['option' => 'B', 'text' => '3,25', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4,00', 'is_correct' => false],
                    ['option' => 'D', 'text' => '3,75', 'is_correct' => false],
                    ['option' => 'E', 'text' => '4,50', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 5,5 - 2,25 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '3,25', 'is_correct' => true],
                    ['option' => 'B', 'text' => '3,50', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4,25', 'is_correct' => false],
                    ['option' => 'D', 'text' => '3,00', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2,75', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 1,2 × 5 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '8', 'is_correct' => false],
                    ['option' => 'B', 'text' => '7', 'is_correct' => false],
                    ['option' => 'C', 'text' => '5', 'is_correct' => false],
                    ['option' => 'D', 'text' => '6', 'is_correct' => true],
                    ['option' => 'E', 'text' => '6.2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 8,4 ÷ 2 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4.2', 'is_correct' => true],
                    ['option' => 'B', 'text' => '4.4', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '5.2', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3.2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pola 2, 4, 6, 8, ... angka berikutnya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '12', 'is_correct' => false],
                    ['option' => 'B', 'text' => '9', 'is_correct' => false],
                    ['option' => 'C', 'text' => '10', 'is_correct' => true],
                    ['option' => 'D', 'text' => '11', 'is_correct' => false],
                    ['option' => 'E', 'text' => '14', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pola 5, 10, 15, 20, ... angka berikutnya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '22', 'is_correct' => false],
                    ['option' => 'B', 'text' => '35', 'is_correct' => false],
                    ['option' => 'C', 'text' => '30', 'is_correct' => false],
                    ['option' => 'D', 'text' => '24', 'is_correct' => false],
                    ['option' => 'E', 'text' => '25', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Pola 3, 6, 12, 24, ... angka berikutnya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '48', 'is_correct' => true],
                    ['option' => 'B', 'text' => '30', 'is_correct' => false],
                    ['option' => 'C', 'text' => '60', 'is_correct' => false],
                    ['option' => 'D', 'text' => '36', 'is_correct' => false],
                    ['option' => 'E', 'text' => '42', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 1 lusin berisi ... buah, jawabannya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '12', 'is_correct' => true],
                    ['option' => 'B', 'text' => '10', 'is_correct' => false],
                    ['option' => 'C', 'text' => '11', 'is_correct' => false],
                    ['option' => 'D', 'text' => '13', 'is_correct' => false],
                    ['option' => 'E', 'text' => '24', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 1 kodi berisi ... buah, jawabannya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '12', 'is_correct' => false],
                    ['option' => 'B', 'text' => '25', 'is_correct' => false],
                    ['option' => 'C', 'text' => '15', 'is_correct' => false],
                    ['option' => 'D', 'text' => '10', 'is_correct' => false],
                    ['option' => 'E', 'text' => '20', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Jika 1 gros berisi ... buah, jawabannya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '100', 'is_correct' => false],
                    ['option' => 'B', 'text' => '144', 'is_correct' => true],
                    ['option' => 'C', 'text' => '150', 'is_correct' => false],
                    ['option' => 'D', 'text' => '120', 'is_correct' => false],
                    ['option' => 'E', 'text' => '200', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rata-rata dari 10, 20, 30, 40 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '35', 'is_correct' => false],
                    ['option' => 'B', 'text' => '20', 'is_correct' => false],
                    ['option' => 'C', 'text' => '22', 'is_correct' => false],
                    ['option' => 'D', 'text' => '30', 'is_correct' => false],
                    ['option' => 'E', 'text' => '25', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Median dari 2, 4, 6, 8, 10 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5', 'is_correct' => false],
                    ['option' => 'C', 'text' => '8', 'is_correct' => false],
                    ['option' => 'D', 'text' => '6', 'is_correct' => true],
                    ['option' => 'E', 'text' => '7', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Modus dari 5, 5, 6, 7, 8 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '7', 'is_correct' => false],
                    ['option' => 'B', 'text' => '8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '6', 'is_correct' => false],
                    ['option' => 'E', 'text' => '5', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Jangkauan data 10, 15, 18, 22 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '11', 'is_correct' => false],
                    ['option' => 'B', 'text' => '15', 'is_correct' => false],
                    ['option' => 'C', 'text' => '10', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '12', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Jika harga barang Rp50.000 naik 10%, harga baru adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Rp55.000', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'Rp52.000', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Rp50.500', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Rp60.000', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Rp54.000', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 40% dari suatu bilangan adalah 20, bilangannya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '45', 'is_correct' => false],
                    ['option' => 'B', 'text' => '50', 'is_correct' => true],
                    ['option' => 'C', 'text' => '60', 'is_correct' => false],
                    ['option' => 'D', 'text' => '40', 'is_correct' => false],
                    ['option' => 'E', 'text' => '80', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 25% dari x = 15, maka x = ...',
                'answers' => [
                    ['option' => 'A', 'text' => '45', 'is_correct' => false],
                    ['option' => 'B', 'text' => '60', 'is_correct' => true],
                    ['option' => 'C', 'text' => '30', 'is_correct' => false],
                    ['option' => 'D', 'text' => '75', 'is_correct' => false],
                    ['option' => 'E', 'text' => '50', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 3 : 5 = x : 20, maka x = ...',
                'answers' => [
                    ['option' => 'A', 'text' => '12', 'is_correct' => true],
                    ['option' => 'B', 'text' => '16', 'is_correct' => false],
                    ['option' => 'C', 'text' => '15', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '10', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika 4 pekerja menyelesaikan pekerjaan dalam 6 hari, secara sederhana 8 pekerja membutuhkan ... hari',
                'answers' => [
                    ['option' => 'A', 'text' => '8', 'is_correct' => false],
                    ['option' => 'B', 'text' => '12', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3', 'is_correct' => true],
                    ['option' => 'D', 'text' => '4', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jarak 120 km ditempuh dalam 3 jam. Kecepatan rata-rata adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '60 km/jam', 'is_correct' => false],
                    ['option' => 'B', 'text' => '30 km/jam', 'is_correct' => false],
                    ['option' => 'C', 'text' => '40 km/jam', 'is_correct' => true],
                    ['option' => 'D', 'text' => '50 km/jam', 'is_correct' => false],
                    ['option' => 'E', 'text' => '80 km/jam', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika kecepatan 60 km/jam selama 2 jam, jarak yang ditempuh adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '180 km', 'is_correct' => false],
                    ['option' => 'B', 'text' => '100 km', 'is_correct' => false],
                    ['option' => 'C', 'text' => '120 km', 'is_correct' => true],
                    ['option' => 'D', 'text' => '60 km', 'is_correct' => false],
                    ['option' => 'E', 'text' => '90 km', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika jarak 150 km ditempuh dengan kecepatan 50 km/jam, waktu yang diperlukan ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4 jam', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5 jam', 'is_correct' => false],
                    ['option' => 'C', 'text' => '2,5 jam', 'is_correct' => false],
                    ['option' => 'D', 'text' => '2 jam', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3 jam', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Keliling persegi dengan sisi 12 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '24 cm', 'is_correct' => false],
                    ['option' => 'B', 'text' => '60 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '144 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '36 cm', 'is_correct' => false],
                    ['option' => 'E', 'text' => '48 cm', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Luas persegi dengan sisi 12 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '120 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '48 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '144 cm²', 'is_correct' => true],
                    ['option' => 'D', 'text' => '24 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '240 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas persegi panjang 15 cm × 8 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '110 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '130 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '120 cm²', 'is_correct' => true],
                    ['option' => 'D', 'text' => '100 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '150 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Keliling persegi panjang 15 cm × 8 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '40 cm', 'is_correct' => false],
                    ['option' => 'B', 'text' => '48 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '60 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '46 cm', 'is_correct' => true],
                    ['option' => 'E', 'text' => '38 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Luas segitiga dengan alas 12 cm dan tinggi 8 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '96 cm²', 'is_correct' => false],
                    ['option' => 'B', 'text' => '56 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '48 cm²', 'is_correct' => true],
                    ['option' => 'D', 'text' => '40 cm²', 'is_correct' => false],
                    ['option' => 'E', 'text' => '24 cm²', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Volume kubus dengan rusuk 6 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '108 cm³', 'is_correct' => false],
                    ['option' => 'B', 'text' => '180 cm³', 'is_correct' => false],
                    ['option' => 'C', 'text' => '256 cm³', 'is_correct' => false],
                    ['option' => 'D', 'text' => '36 cm³', 'is_correct' => false],
                    ['option' => 'E', 'text' => '216 cm³', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Volume balok 8 cm × 5 cm × 3 cm adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '160 cm³', 'is_correct' => false],
                    ['option' => 'B', 'text' => '120 cm²', 'is_correct' => false],
                    ['option' => 'C', 'text' => '120 cm³', 'is_correct' => true],
                    ['option' => 'D', 'text' => '100 cm³', 'is_correct' => false],
                    ['option' => 'E', 'text' => '80 cm³', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika diameter lingkaran 14 cm, jari-jarinya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '28 cm', 'is_correct' => false],
                    ['option' => 'B', 'text' => '5 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '8 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '7 cm', 'is_correct' => true],
                    ['option' => 'E', 'text' => '6 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika jari-jari lingkaran 10 cm, diameternya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5 cm', 'is_correct' => false],
                    ['option' => 'B', 'text' => '15 cm', 'is_correct' => false],
                    ['option' => 'C', 'text' => '10 cm', 'is_correct' => false],
                    ['option' => 'D', 'text' => '20 cm', 'is_correct' => true],
                    ['option' => 'E', 'text' => '30 cm', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai 3/10 dalam persen adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '10%', 'is_correct' => false],
                    ['option' => 'B', 'text' => '30%', 'is_correct' => true],
                    ['option' => 'C', 'text' => '3%', 'is_correct' => false],
                    ['option' => 'D', 'text' => '33%', 'is_correct' => false],
                    ['option' => 'E', 'text' => '20%', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai 7/10 dalam persen adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '75%', 'is_correct' => false],
                    ['option' => 'B', 'text' => '70%', 'is_correct' => true],
                    ['option' => 'C', 'text' => '17%', 'is_correct' => false],
                    ['option' => 'D', 'text' => '7%', 'is_correct' => false],
                    ['option' => 'E', 'text' => '60%', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 2/3 + 2/3 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5/3', 'is_correct' => false],
                    ['option' => 'B', 'text' => '4/3', 'is_correct' => true],
                    ['option' => 'C', 'text' => '2/3', 'is_correct' => false],
                    ['option' => 'D', 'text' => '1', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hasil 5/8 - 1/8 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '6/8', 'is_correct' => false],
                    ['option' => 'B', 'text' => '3/8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1/4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '5/8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '1/2', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil 2/7 × 7 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '14', 'is_correct' => false],
                    ['option' => 'B', 'text' => '1', 'is_correct' => false],
                    ['option' => 'C', 'text' => '7', 'is_correct' => false],
                    ['option' => 'D', 'text' => '9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil 9/10 ÷ 3/5 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '2/3', 'is_correct' => false],
                    ['option' => 'B', 'text' => '4/3', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1/2', 'is_correct' => false],
                    ['option' => 'D', 'text' => '5/2', 'is_correct' => false],
                    ['option' => 'E', 'text' => '3/2', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Nilai x pada 2x - 4 = 10 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '9', 'is_correct' => false],
                    ['option' => 'B', 'text' => '6', 'is_correct' => false],
                    ['option' => 'C', 'text' => '8', 'is_correct' => false],
                    ['option' => 'D', 'text' => '5', 'is_correct' => false],
                    ['option' => 'E', 'text' => '7', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Nilai x pada 5x + 5 = 30 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => true],
                    ['option' => 'B', 'text' => '8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '4', 'is_correct' => false],
                    ['option' => 'D', 'text' => '6', 'is_correct' => false],
                    ['option' => 'E', 'text' => '7', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Nilai x pada 7x - 7 = 42 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => false],
                    ['option' => 'B', 'text' => '8', 'is_correct' => false],
                    ['option' => 'C', 'text' => '6', 'is_correct' => false],
                    ['option' => 'D', 'text' => '9', 'is_correct' => false],
                    ['option' => 'E', 'text' => '7', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Nilai x pada 3(x + 2) = 15 adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4', 'is_correct' => false],
                    ['option' => 'B', 'text' => '2', 'is_correct' => false],
                    ['option' => 'C', 'text' => '3', 'is_correct' => true],
                    ['option' => 'D', 'text' => '6', 'is_correct' => false],
                    ['option' => 'E', 'text' => '5', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika x=2 dan y=3, nilai x+y adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '5', 'is_correct' => true],
                    ['option' => 'B', 'text' => '7', 'is_correct' => false],
                    ['option' => 'C', 'text' => '1', 'is_correct' => false],
                    ['option' => 'D', 'text' => '6', 'is_correct' => false],
                    ['option' => 'E', 'text' => '4', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Jika x=4 dan y=2, nilai 2x+y adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '12', 'is_correct' => false],
                    ['option' => 'B', 'text' => '9', 'is_correct' => false],
                    ['option' => 'C', 'text' => '6', 'is_correct' => false],
                    ['option' => 'D', 'text' => '8', 'is_correct' => false],
                    ['option' => 'E', 'text' => '10', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Bentuk sederhana dari 4a + 3b - 2a adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => '4a + b', 'is_correct' => false],
                    ['option' => 'B', 'text' => '6a + 3b', 'is_correct' => false],
                    ['option' => 'C', 'text' => '2a + 3b', 'is_correct' => true],
                    ['option' => 'D', 'text' => '7ab', 'is_correct' => false],
                    ['option' => 'E', 'text' => '2a + b', 'is_correct' => false],
                ],
            ],
        ];

        $this->insertQuestions('Matematika', $questions);
    }
    /**
     * ============================
     * BAHASA INDONESIA (150 soal)
     * ============================
     */
    protected function seedBahasaIndonesia(): void
    {
        $questions = [
            [
                'payload' => 'Sinonim kata \'cerdas\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lambat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'malas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'lemah', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'bodoh', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pandai', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Antonim kata \'tinggi\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'luas', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'besar', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'rendah', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'lebar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'panjang', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku yang tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'aktivitaas', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'aktifitas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'aktifitaz', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'aktivitas', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'aktipitas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'ijin\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ijin', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ijien', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'izjin', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ijinlah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'izin', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Lawan kata \'rajin\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ulet', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'aktif', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'giat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'malas', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'tekun', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Persamaan kata \'indah\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kotor', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'buruk', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'elok', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'kasar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sempit', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tanda baca pada akhir kalimat tanya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'titik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tanda seru', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tanda tanya', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'koma', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'titik dua', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tanda baca pada akhir kalimat berita adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'titik koma', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'titik', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'koma', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tanda tanya', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanda seru', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat yang termasuk kalimat perintah adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Hari ini hujan.', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Ayah pergi ke kantor.', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Tolong tutup pintu itu!', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Apakah kamu sudah makan?', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Adik sedang belajar.', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata dasar dari \'membaca\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'terbaca', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'pembaca', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'bacaan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'baca', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'membaca', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata dasar dari \'pelajaran\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mengajar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'pelajar', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ajar', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'belajar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pelajaran', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat efektif yang tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Semua para siswa sedang belajar.', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Para siswa semuanya sedang belajar bersama-sama.', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Para siswa-siswa sedang belajar.', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Para siswa sedang belajar.', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'Para siswa sedang belajar-belajar.', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Penulisan nama kota yang tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Medan', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'medan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'meDan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'MEDAN', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'mEdAn', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Penulisan kata depan yang tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'di-rumah', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'di rumah', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'diRumah', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'dirumah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'd irumah', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Penulisan kata depan yang tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kePasar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'k e pasar', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ke-pasar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kepasar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ke pasar', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kata \'berlari\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sifat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ganti', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kerja', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'benda', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'merah\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ganti', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kerja', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sifat', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'benda', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'bilangan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'sekolah\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'benda', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'keterangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kerja', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sifat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Membaca dengan suara keras disebut membaca ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cepat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'diam', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sekilas', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'dalam hati', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'nyaring', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kegiatan mendengarkan dengan sungguh-sungguh disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'menyimak', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'menulis', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'menggambar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'berbicara', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'membaca', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Novel termasuk karya ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'fiksi', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'laporan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'berita', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ilmiah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'nonfiksi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Buku yang berisi fakta dan pengetahuan termasuk ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dongeng', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'cerpen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'puisi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'fiksi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'nonfiksi', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Dongeng biasanya mengandung ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'rumus matematika', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'iklan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pesan moral', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'data statistik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'berita aktual', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gagasan utama dalam paragraf disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kata kunci', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kalimat penjelas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ide pokok', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'judul', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'kesimpulan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat yang menjelaskan ide pokok disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kalimat tanya', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kalimat utama', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kalimat penjelas', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'judul', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'kalimat perintah', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Paragraf dengan ide pokok di awal disebut paragraf ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'deduktif', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'naratif', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'campuran', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'deskriptif', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'induktif', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Paragraf dengan ide pokok di akhir disebut paragraf ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'induktif', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'deduktif', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'campuran', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'persuasif', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'naratif', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Teks yang menggambarkan objek secara rinci disebut teks ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'argumentasi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'eksposisi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'deskripsi', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'narasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'persuasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Teks yang menceritakan suatu peristiwa disebut teks ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'deskripsi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'eksposisi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'persuasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'prosedur', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'narasi', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Teks yang bertujuan memberikan informasi disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dongeng', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'eksposisi', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'drama', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'cerpen', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'puisi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Teks yang bertujuan memengaruhi pembaca disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'persuasi', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'narasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'deskripsi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'eksposisi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'laporan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Orang yang memberikan informasi dalam wawancara disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pewawancara', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'narasumber', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'pendengar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pembaca', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'penulis', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Orang yang mengajukan pertanyaan dalam wawancara disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'narator', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'narasumber', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pembaca', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pendengar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pewawancara', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Informasi yang benar-benar terjadi disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pendapat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'imajinasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'opini', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'dugaan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'fakta', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Pernyataan berdasarkan pendapat seseorang disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'laporan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'fakta', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'data', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'opini', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'bukti', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Berita sebaiknya disampaikan secara ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tidak jelas', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'objektif', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'mengada-ada', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'berlebihan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'subjektif', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Unsur berita yang menjelaskan \'apa\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'why', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'when', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'what', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'who', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'where', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Unsur berita yang menjelaskan \'siapa\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'when', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'how', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'where', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'who', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'what', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Unsur berita yang menjelaskan \'di mana\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'what', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'who', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'why', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'where', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'when', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Unsur berita yang menjelaskan \'kapan\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'what', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'how', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'when', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'who', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'where', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Unsur berita yang menjelaskan \'mengapa\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'where', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'who', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'when', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'why', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'what', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Unsur berita yang menjelaskan \'bagaimana\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'who', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'where', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'when', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'why', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'how', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kata penghubung yang menyatakan sebab adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'karena', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'atau', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'agar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tetapi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'dan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata penghubung yang menyatakan akibat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sehingga', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'tetapi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'atau', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'agar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'karena', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata penghubung yang menyatakan tujuan adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'agar', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'sehingga', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'karena', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'namun', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tetapi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'namun\' menyatakan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tujuan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'penambahan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pertentangan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kata \'selain itu\' menyatakan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'penambahan', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'sebab', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'atau\' digunakan untuk menyatakan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pilihan', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'penjelasan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'dan\' digunakan untuk menyatakan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'penambahan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kata \'tetapi\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'penambahan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tujuan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pertentangan', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'sebab', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'karena\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'penambahan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sebab', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pilihan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'sehingga\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'akibat', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tujuan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata ganti orang pertama tunggal adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kalian', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'dia', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'saya', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'kamu', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'mereka', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata ganti orang kedua tunggal adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kamu', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'mereka', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'saya', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kami', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'dia', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata ganti orang ketiga tunggal adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'aku', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kita', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kamu', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'dia', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'kami', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'sangat\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'benda', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kerja', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ganti', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'keterangan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Subjek pada kalimat \'Ayah membaca koran\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Ayah membaca', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'koran', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'membaca koran', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'membaca', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Ayah', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Objek pada kalimat \'Ayah membaca koran\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'membaca', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Ayah', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'koran', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Ayah membaca', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'di rumah', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Predikat pada kalimat \'Siti menyapu halaman\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Siti menyapu', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'menyapu', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'di halaman', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'halaman', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Siti', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata dasar \'kebersihan\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'bersihkan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'bersih-bersih', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'membersihkan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kebersih', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'bersih', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kalimat yang menggunakan kata depan dengan tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Ibu pergi kepasar.', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Ibu pergi kePasar.', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Ibu pergi ke-pasar.', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Ibu kepasar pergi.', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Ibu pergi ke pasar.', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kalimat yang menggunakan \'di\' sebagai kata depan dengan tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Buku itu di meja.', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'Buku itu diMeja.', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Buku itu dimeja-meja.', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Buku itu di-meja.', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Buku itu dimeja.', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat yang menggunakan imbuhan meN- dengan tepat adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Rina terbaca buku.', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Rina membacai buku.', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Rina membaca buku.', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Rina membaca-baca buku.', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Rina baca buku.', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Judul karangan sebaiknya ditulis dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'seluruhnya berupa angka', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tidak berkaitan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sangat panjang', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'singkat dan sesuai isi', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'kata-kata acak', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Ringkasan harus memuat ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'inti informasi', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'contoh saja', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'semua kalimat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kata sulit saja', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'judul saja', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tujuan membuat ringkasan adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mengubah fakta', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'memadatkan isi bacaan', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'menghilangkan semua informasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'membuat judul baru', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'menambah cerita', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat utama dalam paragraf berisi ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kata sulit', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'contoh saja', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'data tambahan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kalimat penutup saja', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gagasan utama', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kalimat penjelas harus ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'menghapus ide pokok', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'bertentangan dengan ide pokok', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tidak berhubungan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'mengganti judul', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'mendukung ide pokok', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kegiatan menyampaikan informasi di depan banyak orang disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'membaca', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'menulis', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'presentasi', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'menyimak', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'observasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Orang yang mendengarkan pembicaraan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pewawancara', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'narator', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'penulis', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pendengar', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'pembicara', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bahasa dalam laporan sebaiknya ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ambigu', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tidak teratur', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'baku dan jelas', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'berlebihan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gaul', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Teks prosedur berisi ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cerita khayalan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'berita terkini', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pendapat pribadi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'langkah-langkah melakukan sesuatu', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'puisi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tujuan teks prosedur adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'menyampaikan kritik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'memberi petunjuk', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'menghibur saja', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'menceritakan tokoh', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'menggambarkan perasaan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh teks prosedur adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cara membuat jus', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'berita', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'puisi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'cerpen', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'novel', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat ajakan biasanya ditandai kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mari', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'meskipun', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sehingga', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tetapi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'karena', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat larangan biasanya ditandai kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ayo', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'silakan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'mari', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'hendaknya', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'jangan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kalimat tanya biasanya diakhiri dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'titik dua', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tanda hubung', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'koma', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'titik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanda tanya', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kalimat seruan biasanya diakhiri dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'titik koma', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tanda petik', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tanda seru', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'koma', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'titik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'rumah\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'keterangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kerja', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'benda', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sifat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'berjalan\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'benda', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kerja', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sifat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ganti', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'cantik\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'benda', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sifat', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kerja', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ganti', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'tiga\' termasuk kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ganti', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sifat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'bilangan', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'benda', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'kerja', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'mereka\' termasuk kata ganti orang ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ketiga', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'kedua', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'keempat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pertama', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tunggal', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'kami\' termasuk kata ganti orang ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pertama', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'keempat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ketiga', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kedua', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tunggal', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'kalian\' termasuk kata ganti orang ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kedua', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'tunggal', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'keempat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ketiga', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pertama', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Majas yang membandingkan dua hal menggunakan kata seperti \'bagai\' disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ironi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'metafora', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'hiperbola', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'simile', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'personifikasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Majas yang memberikan sifat manusia kepada benda disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ironi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'simile', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'litotes', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'personifikasi', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'metafora', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Majas yang menggunakan perbandingan langsung disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'repetisi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ironi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'metafora', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'personifikasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'simile', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Majas yang melebih-lebihkan sesuatu disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'litotes', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'hiperbola', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'simile', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'metafora', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'personifikasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Puisi tersusun atas baris dan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'bab', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'judul', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'paragraf', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'dialog', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'bait', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Persamaan bunyi pada akhir baris puisi disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'alur', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tokoh', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tema', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'rima', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'latar', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pesan yang ingin disampaikan pengarang disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'latar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sudut pandang', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'amanat', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'alur', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tokoh', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gagasan dasar sebuah cerita disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dialog', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'latar', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'amanat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tema', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'alur', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rangkaian peristiwa dalam cerita disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'latar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'amanat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tokoh', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'alur', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'tema', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tempat, waktu, dan suasana dalam cerita disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'amanat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tema', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'latar', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'alur', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tokoh', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pelaku dalam cerita disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'amanat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tema', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tokoh', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'latar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'alur', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tokoh yang menjadi pusat cerita disebut tokoh ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tambahan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'utama', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'sampingan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pendukung', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'figuran', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tokoh yang menentang tokoh utama disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tritagonis', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'antagonis', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'figuran', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'protagonis', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'narator', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tokoh yang mendukung tokoh utama disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'narator', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tritagonis', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'antagonis', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'protagonis', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'figuran', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Percakapan antartokoh disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dialog', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'narasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'prolog', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'deskripsi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'monolog', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pembukaan dalam drama disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'monolog', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'dialog', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'prolog', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'babak', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'epilog', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Penutup dalam drama disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'babak', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'epilog', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'prolog', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'dialog', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'monolog', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Percakapan seorang tokoh dengan dirinya sendiri disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'monolog', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'dialog', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'epilog', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'narasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'prolog', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Surat yang digunakan untuk keperluan resmi disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'surat pribadi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'catatan harian', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'surat dinas', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'surat cinta', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pesan singkat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Surat untuk teman atau keluarga disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'surat pribadi', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'surat tugas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'surat edaran', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'surat dinas', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'surat keputusan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bagian surat yang menunjukkan waktu dan tempat penulisan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lampiran', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'isi surat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'salam penutup', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'perihal', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanggal surat', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Bagian surat yang berisi inti pesan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'salam pembuka', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'isi surat', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'kop surat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'alamat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanggal', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'apotik\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'apoteg', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'apotek', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'apotikkan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'apotik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'apoteq', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'nasehat\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'nasehat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'nasehatt', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'nasi hat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'nasihat', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'nasihatt', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'jaman\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'zhaman', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'jaman', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'zaman', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'jamman', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'dzaman', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'kwalitas\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kwalitas', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kualitas', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'kualitaz', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'qualitas', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'kwalitaz', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'praktek\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'praktik', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'praktek', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'prakteg', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'praktiek', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'praktiek', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata baku dari \'resiko\' adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'risiko', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'resiko', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'risikoo', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'riskho', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'resikho', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat \'Rina rajin belajar sehingga nilainya bagus\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'perbandingan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'akibat', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tujuan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat \'Rajin belajar agar mendapat nilai baik\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tujuan', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pilihan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat \'Doni sakit sehingga tidak masuk sekolah\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'penambahan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'akibat', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'tujuan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat \'Ia rajin, namun nilainya belum memuaskan\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pertentangan', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tujuan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'penambahan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat \'Ibu membeli sayur dan buah\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'penambahan', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'akibat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat \'Kamu memilih teh atau kopi?\' menunjukkan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'pilihan', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'penambahan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pertentangan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata yang digunakan untuk menggantikan nama orang disebut kata ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'keterangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kerja', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'bilangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sifat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ganti', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Laporan hasil pengamatan harus berdasarkan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dugaan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'perasaan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'rumor', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'imajinasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'fakta', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Wawancara dilakukan untuk memperoleh ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'gambar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'puisi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'informasi', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'cerita fiksi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'hiburan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Daftar pertanyaan yang disiapkan sebelum wawancara disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'daftar isi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'glosarium', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'indeks', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'daftar pustaka', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pedoman wawancara', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Daftar sumber yang digunakan dalam karya tulis disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'daftar isi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'daftar pustaka', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'indeks', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'catatan kaki', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'lampiran', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kumpulan kata beserta maknanya disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'novel', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kamus', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'ensiklopedia', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'majalah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'atlas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kumpulan informasi tentang berbagai bidang pengetahuan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'novel', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'surat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'cerpen', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ensiklopedia', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'kamus', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata yang memiliki makna sama disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sinonim', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'polisemi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'homonim', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'akronim', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'antonim', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata yang memiliki makna berlawanan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'homonim', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'hiponim', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'akronim', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sinonim', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'antonim', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Dua kata yang lafalnya sama tetapi maknanya berbeda disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'homonim', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'hiponim', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'antonim', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'akronim', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sinonim', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Singkatan yang menjadi kata baru disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'akronim', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'antonim', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sinonim', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'hiponim', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'homonim', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'besar\' dan \'raksasa\' memiliki hubungan makna ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sinonim', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'homonim', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'hiponim', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'akronim', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'antonim', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'panas\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dingin', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'cerah', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'terbakar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'terik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'hangat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'cepat\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sigap', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'lambat', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'tangkas', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'lekas', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gesit', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'awal\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'akhir', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'pertama', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'depan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'mula', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'permulaan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'hemat\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'irit', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'teliti', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sederhana', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'boros', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'cermat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'jujur\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'amanah', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'bohong', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'benar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'terbuka', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tulus', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'aktif\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'rajin', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sibuk', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'cekatan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pasif', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'giat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'mudah\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lancar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sulit', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'ringan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sederhana', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'praktis', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'kuat\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tangguh', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'lemah', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'tegar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'perkasa', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'kokoh', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'terang\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'putih', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'gelap', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'cerah', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'bersinar', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'jelas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'bersih\' berlawanan makna dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kotor', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'jernih', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'rapi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'indah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'wangi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tanda baca untuk memisahkan unsur dalam perincian adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tanda tanya', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'koma', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'tanda seru', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'titik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanda petik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tanda baca yang mengapit petikan langsung adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'koma', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tanda petik', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'tanda kurung', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'titik dua', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanda hubung', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tanda baca yang digunakan sebelum perincian adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'titik dua', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'koma', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tanda petik', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'titik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tanda tanya', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'karena\' pada kalimat \'Ia tidak hadir karena sakit\' menyatakan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tujuan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sebab', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'akibat', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'agar\' pada kalimat \'Belajar agar pintar\' menyatakan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'akibat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sebab', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pertentangan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tujuan', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'pilihan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kata \'meskipun\' menyatakan hubungan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pilihan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tujuan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pertentangan', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'penambahan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sebab', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat yang mengandung opini adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Bumi mengelilingi Matahari.', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Menurut saya, film itu sangat menarik.', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'Air mendidih pada 100°C.', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Matahari terbit dari timur.', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Indonesia memiliki banyak pulau.', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kalimat yang mengandung fakta adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Air membeku pada suhu 0°C.', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'Sekolah itu terasa membosankan.', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Menurut saya, matematika sulit.', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Film itu sangat bagus.', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Makanan ini paling lezat.', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tujuan utama iklan adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'membuat laporan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'menarik minat konsumen', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'menyampaikan dongeng', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'menulis puisi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'menceritakan sejarah', 'is_correct' => false],
                ],
            ],
        ];

        $this->insertQuestions('Bahasa Indonesia', $questions);
    }
    /**
     * ============================
     * IPA (150 soal)
     * ============================
     */
    protected function seedIpa(): void
    {
        $questions = [
            [
                'payload' => 'Unit terkecil penyusun makhluk hidup adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'organ', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sistem organ', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'organisme', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'jaringan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sel', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Organ utama pernapasan manusia adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'hati', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'lambung', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ginjal', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'jantung', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'paru-paru', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Organ yang berfungsi memompa darah adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'usus', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ginjal', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'hati', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'paru-paru', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'jantung', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Organ yang berfungsi menyaring darah adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kulit', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'jantung', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ginjal', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'paru-paru', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'lambung', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Proses tumbuhan membuat makanan sendiri disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'respirasi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'fotosintesis', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'evaporasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'fermentasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'transpirasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Zat hijau daun yang berperan dalam fotosintesis disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'insulin', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'melanin', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'keratin', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'hemoglobin', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'klorofil', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Gas yang dibutuhkan tumbuhan untuk fotosintesis adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'helium', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'hidrogen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'oksigen', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'nitrogen', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'karbon dioksida', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Gas yang dihasilkan dalam fotosintesis adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'oksigen', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'nitrogen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'karbon dioksida', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'metana', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'hidrogen', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tempat pertukaran gas pada paru-paru adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'laring', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'trakea', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'diafragma', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'alveolus', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'bronkus', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Saluran yang menghubungkan tenggorokan dengan paru-paru disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'arteri', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kerongkongan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ureter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'usus', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'bronkus', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Tulang yang melindungi otak adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'rusuk', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'belakang', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tengkorak', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'paha', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'selangka', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tulang yang melindungi jantung dan paru-paru adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tulang paha', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tulang tengkorak', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tulang lengan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tulang rusuk', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'tulang betis', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Vitamin yang banyak terdapat pada wortel adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'vitamin K', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'vitamin D', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'vitamin A', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'vitamin B12', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'vitamin C', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Vitamin yang membantu pembekuan darah adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'vitamin A', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'vitamin C', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'vitamin K', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'vitamin D', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'vitamin B', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sumber energi utama bagi tubuh adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mineral', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'air', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'karbohidrat', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'serat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'vitamin', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Zat pembangun tubuh yang utama adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'protein', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'mineral', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'vitamin', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'karbohidrat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'air', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Mineral penting untuk pembentukan tulang adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'natrium', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'iodium', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kalium', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'klorin', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'kalsium', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Kekurangan vitamin C dapat menyebabkan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'rakitis', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'gondok', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'rabun senja', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sariawan', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'anemia', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kekurangan vitamin D dapat menyebabkan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'rakitis', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'sariawan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'scurvy', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'beri-beri', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gondok', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kekurangan zat besi dapat menyebabkan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'influenza', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'rakitis', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'anemia', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'gondok', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'diabetes', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hewan yang memakan tumbuhan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'insektivor', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'karnivor', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'detritivor', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'omnivor', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'herbivor', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hewan yang memakan daging disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'detritivor', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'frugivor', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'herbivor', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'karnivor', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'omnivor', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hewan yang memakan tumbuhan dan hewan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'omnivor', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'produsen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'karnivor', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'insektivor', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'herbivor', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Organisme yang membuat makanan sendiri disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'predator', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'dekomposer', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'konsumen', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'produsen', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'parasit', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Organisme yang menguraikan sisa makhluk hidup disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'predator', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'dekomposer', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'herbivor', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'produsen', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'konsumen', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hubungan dua makhluk hidup yang saling menguntungkan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'parasitisme', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'predasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'komensalisme', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kompetisi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'mutualisme', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hubungan dua makhluk hidup, satu untung dan satu dirugikan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mutualisme', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'parasitisme', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'netralisme', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'predasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'komensalisme', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Hubungan satu makhluk hidup untung dan yang lain tidak dirugikan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'parasitisme', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'predasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kompetisi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'komensalisme', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'mutualisme', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Urutan makan dan dimakan dalam ekosistem disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'habitat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'rantai makanan', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'jaring-jaring makanan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'populasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'siklus air', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kumpulan beberapa rantai makanan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'habitat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'komunitas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'populasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'rantai makanan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'jaring-jaring makanan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Tempat hidup suatu organisme disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'habitat', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'ekosistem', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'populasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'biosfer', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'komunitas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kumpulan individu sejenis di suatu tempat disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'biosfer', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'populasi', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'habitat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'komunitas', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ekosistem', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Kumpulan berbagai populasi yang hidup bersama disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'komunitas', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'populasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'habitat', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'spesies', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'organisme', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Ekosistem terdiri atas komponen ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'organik dan anorganik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'produsen dan konsumen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'hewan dan tumbuhan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'biotik dan abiotik', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'air dan tanah', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh komponen abiotik adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'bakteri', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'air', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'tumbuhan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'jamur', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'hewan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh komponen biotik adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cahaya', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'suhu', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'air', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'tanah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tumbuhan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Perubahan air menjadi uap disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pengembunan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'penyubliman', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pembekuan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pencairan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'penguapan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Perubahan uap air menjadi cair disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pengembunan', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'pembekuan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'penyubliman', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'penguapan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pencairan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perubahan air menjadi es disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'penguapan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'pengembunan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pembekuan', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'pencairan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'penyubliman', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perubahan es menjadi air disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pembekuan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'penyubliman', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pengembunan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'penguapan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pencairan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Perubahan padat langsung menjadi gas disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mengembun', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'membeku', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'menyublim', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'menguap', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'mencair', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perubahan gas langsung menjadi padat disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'menguap', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'mengkristal', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'mencair', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'mengembun', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'membeku', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Air mendidih pada tekanan normal pada suhu ...',
                'answers' => [
                    ['option' => 'A', 'text' => '100°C', 'is_correct' => true],
                    ['option' => 'B', 'text' => '80°C', 'is_correct' => false],
                    ['option' => 'C', 'text' => '0°C', 'is_correct' => false],
                    ['option' => 'D', 'text' => '120°C', 'is_correct' => false],
                    ['option' => 'E', 'text' => '50°C', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Air membeku pada suhu ...',
                'answers' => [
                    ['option' => 'A', 'text' => '-10°C', 'is_correct' => false],
                    ['option' => 'B', 'text' => '0°C', 'is_correct' => true],
                    ['option' => 'C', 'text' => '100°C', 'is_correct' => false],
                    ['option' => 'D', 'text' => '10°C', 'is_correct' => false],
                    ['option' => 'E', 'text' => '50°C', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Alat untuk mengukur suhu adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dinamometer', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'amperemeter', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'barometer', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'termometer', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'higrometer', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Alat untuk mengukur tekanan udara adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'barometer', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'higrometer', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'termometer', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'neraca', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'voltmeter', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Alat untuk mengukur kelembapan udara adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'termometer', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'higrometer', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'amperemeter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'barometer', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'dinamometer', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gaya dapat menyebabkan benda ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'bergerak atau berubah bentuk', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'hilang massanya', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'berubah menjadi gas', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'selalu diam', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'bertambah volumenya tanpa sebab', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan SI untuk gaya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'meter', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'newton', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'watt', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'joule', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pascal', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Alat untuk mengukur gaya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'dinamometer', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'termometer', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'voltmeter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'neraca', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'barometer', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gaya yang menarik benda menuju pusat Bumi disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'gaya listrik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'gaya pegas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'gaya magnet', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'gaya gravitasi', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'gaya gesek', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gaya yang menghambat gerak benda akibat bersentuhan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'gaya listrik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'gaya gravitasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'gaya gesek', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'gaya magnet', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gaya apung', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gaya yang ditimbulkan magnet disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'gaya otot', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'gaya pegas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'gaya magnet', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'gaya gesek', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gaya gravitasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sumber energi utama bagi Bumi adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'minyak bumi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'angin', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Matahari', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Bulan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'batu bara', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Energi yang dimiliki benda karena geraknya disebut energi ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kimia', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'cahaya', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'bunyi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kinetik', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'potensial', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Energi yang dimiliki benda karena kedudukannya disebut energi ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cahaya', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kinetik', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'bunyi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'potensial', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'listrik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan SI energi adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'joule', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'pascal', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'newton', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'watt', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ampere', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan daya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'volt', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'newton', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'watt', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'meter', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'joule', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Energi listrik dapat diubah menjadi energi cahaya pada ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sepeda', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'setrika', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kipas', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'lampu', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'kompor gas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Energi listrik diubah menjadi energi gerak pada ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kipas angin', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'kompor gas', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'setrika', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'radio pasif', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'lampu', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Benda yang dapat menghantarkan listrik dengan baik disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'resistor', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'konduktor', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'semikonduktor', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'isolator', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'magnet', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh bahan konduktor adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kaca', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'karet', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tembaga', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'kayu', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'plastik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh bahan isolator adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'karet', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'besi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tembaga', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'aluminium', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'perak', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Arus listrik mengalir karena adanya ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'gaya gravitasi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'perubahan massa', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'beda potensial', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'cahaya', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'panas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan kuat arus listrik adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ohm', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ampere', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'watt', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'volt', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'joule', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan tegangan listrik adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ampere', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'volt', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'pascal', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ohm', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'watt', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan hambatan listrik adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ampere', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'watt', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'volt', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ohm', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'joule', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rangkaian listrik dengan satu jalur disebut rangkaian ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'terbuka', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'seri', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'bercabang', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'campuran', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'paralel', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rangkaian listrik dengan lebih dari satu jalur disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tunggal', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'seri', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tertutup', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'paralel', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'terbuka', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bunyi memerlukan ... untuk merambat',
                'answers' => [
                    ['option' => 'A', 'text' => 'listrik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'magnet', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'cahaya', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'medium', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'ruang hampa', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bunyi tidak dapat merambat melalui ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kayu', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'udara', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ruang hampa', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'air', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'besi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satuan frekuensi adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'watt', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'newton', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'meter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'joule', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'hertz', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Bunyi dengan frekuensi di bawah 20 Hz disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'supersonik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ultrasonik', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sonik', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'infrasonik', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'audiosonik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bunyi dengan frekuensi di atas 20.000 Hz disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'audiosonik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sonik', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ultrasonik', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'subsonik', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'infrasonik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Cahaya merambat secara ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lurus', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'acak', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'zig-zag', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'berkelok-kelok', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'melingkar', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Benda yang dapat ditembus cahaya disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'opak', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'gelap', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'magnetik', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'transparan', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'reflektif', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Benda yang tidak dapat ditembus cahaya disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'konduktor', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tembus cahaya', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'opak', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'transparan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'bening', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pemantulan cahaya pada permukaan rata disebut pemantulan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sempurna', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'baur', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'tunggal', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'acak', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'teratur', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Lensa yang mengumpulkan cahaya disebut lensa ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'datar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'cekung', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'silinder', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'prisma', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'cembung', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Lensa yang menyebarkan cahaya disebut lensa ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'cembung', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'datar', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'cekung', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'prisma', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'silinder', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Planet tempat manusia hidup adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Mars', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Merkurius', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Venus', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Bumi', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'Jupiter', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Planet terdekat dengan Matahari adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Mars', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Merkurius', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'Jupiter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Bumi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Venus', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Planet terbesar dalam tata surya adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Neptunus', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Saturnus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Jupiter', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Bumi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Mars', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Planet yang dikenal sebagai Planet Merah adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Merkurius', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Saturnus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Jupiter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Mars', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'Venus', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Satelit alami Bumi adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Venus', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Mars', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Matahari', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Jupiter', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Bulan', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Gerak Bumi mengelilingi Matahari disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'presesi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'translasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'rotasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'gravitasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'revolusi', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Gerak Bumi berputar pada porosnya disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'orbit', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'revolusi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'gravitasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'translasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'rotasi', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Akibat utama rotasi Bumi adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pasang surut', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'tahun kabisat', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'gerhana Matahari', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'siang dan malam', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'pergantian musim', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Akibat revolusi Bumi antara lain ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'gempa', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'terjadinya siang setiap jam', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pasang surut saja', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pergantian musim', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'siang dan malam', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gerhana Matahari terjadi ketika ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Bulan berada di antara Matahari dan Bumi', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'Bumi berhenti berotasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Matahari di antara Bumi dan Bulan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'Bulan berada jauh dari Bumi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Bumi di antara Matahari dan Bulan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gerhana Bulan terjadi ketika ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'Matahari di antara Bumi dan Bulan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'Bulan berada di antara dua planet', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'Bumi berada di antara Matahari dan Bulan', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'Bumi berhenti berevolusi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'Bulan di antara Matahari dan Bumi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Lapisan atmosfer tempat terjadinya cuaca adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'stratosfer', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'termosfer', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'eksosfer', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'mesosfer', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'troposfer', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Lapisan ozon banyak terdapat di ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'termosfer', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'mesosfer', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'eksosfer', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'stratosfer', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'troposfer', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Batuan yang terbentuk dari pembekuan magma disebut batuan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'beku', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'sedimen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'metamorf', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kapur', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'organik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Batuan yang terbentuk dari pengendapan disebut batuan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'beku', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'magma', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'vulkanik', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sedimen', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'metamorf', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Batuan yang berubah karena tekanan dan suhu tinggi disebut batuan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'organik', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'beku', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'metamorf', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'pasir', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'sedimen', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gunung api mengeluarkan material berupa ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'es', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'oksigen murni', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'air laut', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'lava', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'salju', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gempa yang disebabkan pergeseran lempeng disebut gempa ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'tektonik', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'buatan', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'vulkanik', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'termal', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'runtuhan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gempa akibat aktivitas gunung api disebut gempa ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'vulkanik', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'laut', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'runtuhan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'buatan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'tektonik', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Lapisan Bumi tempat kita hidup disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mantel bawah', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'inti dalam', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kerak Bumi', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'mesosfer', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'inti luar', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Proses peredaran air di Bumi disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'siklus karbon', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'siklus energi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'siklus batuan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'siklus nitrogen', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'siklus air', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hujan terjadi ketika uap air mengalami ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'fotosintesis', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kondensasi', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'pembakaran', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pembekuan total', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'fermentasi', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gas terbanyak dalam atmosfer Bumi adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'helium', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'oksigen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'hidrogen', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'karbon dioksida', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'nitrogen', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Gas yang dibutuhkan manusia untuk bernapas adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'oksigen', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'nitrogen', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'hidrogen', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'helium', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'karbon dioksida', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rumus kimia air adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'H2O', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'O2', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'H2', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'NaCl', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'CO2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Rumus kimia karbon dioksida adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'NaCl', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'H2O', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'CO', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'O2', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'CO2', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Garam dapur memiliki rumus kimia ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'HCl', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'H2O', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'O2', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'NaCl', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'CO2', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Zat dengan pH kurang dari 7 bersifat ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'garam', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'logam', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'asam', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'basa', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'netral', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Zat dengan pH lebih dari 7 bersifat ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'asam', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'netral', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'basa', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'garam', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'oksida', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Zat dengan pH 7 bersifat ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'logam', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'garam', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'basa', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'asam', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'netral', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Contoh bahan asam dalam kehidupan sehari-hari adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sabun', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'cuka', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'pasta gigi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'deterjen', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'air kapur', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh bahan basa adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sabun', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'asam jawa', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'jeruk', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'cuka', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'air aki', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perubahan kimia ditandai dengan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'perpindahan tempat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'terbentuknya zat baru', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'perubahan bentuk saja', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'perubahan posisi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'perubahan ukuran saja', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh perubahan kimia adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'besi berkarat', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'kertas dipotong', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'air menguap', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'es mencair', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'gula larut', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Contoh perubahan fisika adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'es mencair', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'kayu terbakar', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'telur matang', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'besi berkarat', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'makanan membusuk', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Campuran yang zat penyusunnya tercampur merata disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'koloid', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'unsur', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'senyawa', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'homogen', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'heterogen', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Campuran air dan pasir termasuk campuran ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'homogen', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'heterogen', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'senyawa', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'larutan murni', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'unsur', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Zat tunggal yang tidak dapat diuraikan secara kimia disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'unsur', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'senyawa', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'larutan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'koloid', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'campuran', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gabungan dua atau lebih unsur secara kimia disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'senyawa', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'atom', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'larutan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'unsur', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'campuran', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Partikel terkecil dari unsur yang masih memiliki sifat unsur disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'jaringan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ion', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'sel', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'atom', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'molekul', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Gabungan dua atau lebih atom disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'molekul', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'populasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'jaringan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'sel', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'organ', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bagian terkecil dari suatu benda yang masih memiliki sifat benda disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ekosistem', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'organ', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'populasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'jaringan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'partikel', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Pusat atom disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'molekul', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ion', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'elektron', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kulit atom', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'inti atom', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Partikel bermuatan negatif adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'molekul', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'elektron', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'atom', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'neutron', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'proton', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Partikel bermuatan positif adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'atom', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'neutron', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'molekul', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'elektron', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'proton', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Partikel yang tidak bermuatan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'molekul', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'elektron', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'proton', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'neutron', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'ion', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Fotosintesis terutama berlangsung di bagian tumbuhan yang mengandung ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mitokondria', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'kloroplas', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'vakuola', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ribosom', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'nukleus', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Akar tumbuhan berfungsi utama untuk ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'menghasilkan suara', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'menangkap serangga', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'membuat biji', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'menghasilkan bunga', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'menyerap air dan mineral', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Batang berfungsi antara lain untuk ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mencerna makanan', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'mengangkut air dan menopang tumbuhan', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'menyerap oksigen dari tanah saja', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'menghasilkan darah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'membentuk tulang', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Daun merupakan tempat utama ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'pergerakan tulang', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'fotosintesis', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'penyaringan darah', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'pemompaan darah', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pencernaan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Bunga berfungsi terutama sebagai alat ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'perkembangbiakan', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'pernapasan manusia', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'pencernaan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'gerak', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'peredaran darah', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perkembangbiakan tumbuhan melalui biji disebut perkembangbiakan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'aseksual', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'fragmentasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'generatif', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'tunas', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'vegetatif', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Perkembangbiakan tanpa peleburan sel kelamin disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'generatif', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'seksual', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'fertilisasi', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'vegetatif', 'is_correct' => true],
                    ['option' => 'E', 'text' => 'penyerbukan', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pertemuan sel sperma dan ovum disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'fragmentasi', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'transpirasi', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'fertilisasi', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'respirasi', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'fotosintesis', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sel kelamin jantan disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'sperma', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'plasenta', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'embrio', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'zigot', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ovum', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sel kelamin betina disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'embrio', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'sperma', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'neuron', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'zigot', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ovum', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Hasil peleburan sperma dan ovum disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'janin', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'zigot', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'sperma', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ovum', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'embrio', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Organ reproduksi pria yang menghasilkan sperma adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'prostat', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'testis', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'rahim', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'ovarium', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ginjal', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Organ reproduksi wanita yang menghasilkan ovum adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'hati', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ovarium', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'ginjal', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'rahim', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'testis', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Tempat berkembangnya janin adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lambung', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'ovarium', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ginjal', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'paru-paru', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'rahim', 'is_correct' => true],
                ],
            ],
            [
                'payload' => 'Darah yang kaya oksigen dari paru-paru menuju jantung melalui ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'kapiler', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'vena pulmonalis', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'aorta', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'vena kava', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'arteri pulmonalis', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pembuluh darah yang membawa darah keluar dari jantung disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'arteri', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'vena', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'ureter', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kapiler', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'limfa', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pembuluh darah yang membawa darah menuju jantung disebut ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'vena', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'trakea', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kapiler', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'arteri', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'aorta', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Pertukaran zat antara darah dan jaringan terjadi melalui ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'arteri besar', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'bronkus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'kapiler', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'aorta', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'vena besar', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Sistem pencernaan dimulai dari ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'mulut', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'usus halus', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'usus besar', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kerongkongan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'lambung', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Organ yang menghasilkan asam lambung adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'ginjal', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'lambung', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'jantung', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'hati', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'pankreas', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Penyerapan sari makanan paling banyak terjadi di ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'usus halus', 'is_correct' => true],
                    ['option' => 'B', 'text' => 'lambung', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'mulut', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'kerongkongan', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'usus besar', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Penyerapan air terutama terjadi di ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'lambung', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'usus besar', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'kerongkongan', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'usus halus', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'mulut', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Organ yang menghasilkan empedu adalah ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'paru-paru', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'hati', 'is_correct' => true],
                    ['option' => 'C', 'text' => 'jantung', 'is_correct' => false],
                    ['option' => 'D', 'text' => 'lambung', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'ginjal', 'is_correct' => false],
                ],
            ],
            [
                'payload' => 'Empedu membantu proses pencernaan ...',
                'answers' => [
                    ['option' => 'A', 'text' => 'protein', 'is_correct' => false],
                    ['option' => 'B', 'text' => 'air', 'is_correct' => false],
                    ['option' => 'C', 'text' => 'lemak', 'is_correct' => true],
                    ['option' => 'D', 'text' => 'mineral', 'is_correct' => false],
                    ['option' => 'E', 'text' => 'vitamin', 'is_correct' => false],
                ],
            ],
        ];

        $this->insertQuestions('IPA', $questions);
    }
}
