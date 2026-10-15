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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            // salinan judul, agar histori tetap ada jika ujian dihapus
            $table->string('exam_title');

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('submitted_at'); // tanggal ujian
            $table->unsignedInteger('total_questions');
            $table->unsignedInteger('correct_count');
            $table->unsignedInteger('wrong_count'); // termasuk yang tidak dijawab
            $table->decimal('score', 5, 2);         // skor total (0-100)
            $table->boolean('is_passed')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};