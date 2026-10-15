<?php

namespace App\Filament\Resources\ExamResults\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExamResultsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('exam_title')
                    ->label('Ujian')
                    ->searchable()
                    ->sortable(),
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
            ->filters([
                SelectFilter::make('is_passed')
                    ->label('Status kelulusan')
                    ->options([
                        1 => 'Lulus',
                        0 => 'Tidak lulus',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()->label('Lihat detail'),
            ]);
    }
}