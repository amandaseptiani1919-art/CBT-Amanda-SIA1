<?php

namespace App\Filament\Resources\ExamResults\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExamResultInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Ringkasan')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('student.name')->label('Siswa'),
                    TextEntry::make('exam_title')->label('Ujian'),
                    TextEntry::make('submitted_at')
                        ->label('Tanggal ujian')
                        ->dateTime('d F Y, H:i'),
                    TextEntry::make('score')->label('Skor total'),
                    TextEntry::make('correct_count')->label('Jawaban benar'),
                    TextEntry::make('wrong_count')->label('Jawaban salah'),
                ]),
            Section::make('Detail jawaban')
                ->columnSpanFull()
                ->schema([
                    RepeatableEntry::make('details')
                        ->hiddenLabel()
                        ->columns(2)
                        ->schema([
                            TextEntry::make('subject_name')
                                ->label('Mata pelajaran'),
                            TextEntry::make('is_correct')
                                ->label('Status')
                                ->badge()
                                ->formatStateUsing(fn ($state) => $state ? 'Benar' : 'Salah')
                                ->color(fn ($state) => $state ? 'success' : 'danger'),
                            TextEntry::make('question_text')
                                ->label('Soal')
                                ->html()
                                ->columnSpanFull(),
                            TextEntry::make('answer_text')
                                ->label('Jawaban siswa')
                                ->placeholder('Tidak dijawab'),
                            TextEntry::make('correct_answer_text')
                                ->label('Kunci jawaban'),
                        ]),
                ]),
        ]);
    }
}