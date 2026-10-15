<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_result_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_result_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('subject_name');

            $table->foreignId('question_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->text('question_text');

            // jawaban yang dipilih siswa
            $table->foreignId('answer_id')
                ->nullable()
                ->constrained('answers')
                ->nullOnDelete();
            $table->string('answer_text')->nullable();

            // kunci jawaban
            $table->foreignId('correct_answer_id')
                ->nullable()
                ->constrained('answers')
                ->nullOnDelete();
            $table->string('correct_answer_text')->nullable();

            $table->boolean('is_correct')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_result_details');
    }
};