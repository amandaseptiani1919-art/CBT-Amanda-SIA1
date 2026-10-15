<?php

namespace App\Filament\Test\Resources\ExamResults;

use App\Filament\Test\Resources\ExamResults\Pages\ListExamResults;
use App\Filament\Test\Resources\ExamResults\Pages\ViewExamResult;
use App\Models\ExamResult;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'Riwayat Hasil Ujian';

    protected static ?string $modelLabel = 'Hasil Ujian';

    // Siswa hanya boleh melihat hasil miliknya sendiri
    public static function getEloquentQuery(): Builder
    {
        /** @var \App\Models\User|null $user */
        $user = Filament::auth()->user();

        return parent::getEloquentQuery()
            ->where('student_id', $user?->student?->id);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exam_title')
                    ->label('Ujian')
                    ->searchable(),
                TextColumn::make('submitted_at')
                    ->label('Tanggal ujian')
                    ->dateTime('d F Y, H:i')
                    ->sortable(),
                TextColumn::make('score')
                    ->label('Skor')
                    ->sortable(),
                TextColumn::make('correct_count')
                    ->label('Benar'),
                TextColumn::make('wrong_count')
                    ->label('Salah'),
                IconColumn::make('is_passed')
                    ->label('Lulus')
                    ->boolean(),
            ])
            ->defaultSort('submitted_at', 'desc')
            ->recordActions([
                ViewAction::make()->label('Lihat detail'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Ringkasan')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('exam_title')->label('Ujian'),
                    TextEntry::make('student.name')->label('Siswa'),
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

    public static function getPages(): array
    {
        return [
            'index' => ListExamResults::route('/'),
            'view' => ViewExamResult::route('/{record}'),
        ];
    }
}