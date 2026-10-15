<?php

namespace App\Filament\Test\Resources\Exams;

use App\Filament\Test\Resources\ExamResults\ExamResultResource;
use App\Filament\Test\Resources\Exams\Pages\ManageExams;
use App\Filament\Test\Resources\Exams\Pages\StartingExam;
use App\Models\Exam;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedPencilSquare;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Sesi Ujian';

    protected static ?string $modelLabel = 'Ujian';

    public static function table(Table $table): Table
    {
        /** @var \App\Models\User|null $user */
        $user = Filament::auth()->user();
        $studentId = $user?->student?->id;

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($studentId) {
                $now = now();

                $query
                    ->where('is_available', true)
                    ->where(function (Builder $query) use ($now) {
                        $query
                            ->where(fn (Builder $query) => $query
                                ->where('exact_time', true)
                                ->where('started_at', '<=', $now)
                                ->whereRaw(
                                    'DATE_ADD(started_at, INTERVAL duration MINUTE) >= ?',
                                    [$now]
                                ))
                            ->orWhere(fn (Builder $query) => $query
                                ->whereNotNull('expired_at')
                                ->where('expired_at', '>=', $now));
                    })
                    ->with(['examResults' => fn ($q) => $q->where('student_id', $studentId)]);
            })
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Ujian')
                    ->searchable(),
                TextColumn::make('duration')
                    ->label('Durasi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('threshold')
                    ->label('Min. Score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('started_at')
                    ->label('Mulai')
                    ->dateTime('d F, Y, H:i:s')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('start')
                    ->label('Mulai ujian')
                    ->icon(Heroicon::OutlinedPaperAirplane)
                    ->color('primary')
                    ->button()
                    ->visible(fn ($record) => $record->examResults->isEmpty())
                    ->disabled(fn ($record) => $record->started_at >= now())
                    ->url(fn ($record) => route(
                        StartingExam::getRouteName(),
                        ['exam' => $record]
                    )),

                Action::make('selesai')
                    ->label('Selesai')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->button()
                    ->disabled()
                    ->visible(fn ($record) => $record->examResults->isNotEmpty()),

                Action::make('lihatDetail')
                    ->label('Lihat detail')
                    ->icon(Heroicon::OutlinedEye)
                    ->color('gray')
                    ->button()
                    ->visible(fn ($record) => $record->examResults->isNotEmpty())
                    ->url(fn ($record) => ExamResultResource::getUrl('view', [
                        'record' => $record->examResults->first()?->id,
                    ])),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageExams::route('/'),
            'mulai' => StartingExam::route('/{exam}/mulai'),
        ];
    }
}