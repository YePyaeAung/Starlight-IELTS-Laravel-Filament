<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarkResource\Pages;
use App\Filament\Resources\MarkResource\RelationManagers;
use App\Filament\Resources\MarkResource\RelationManagers\StudentRelationManager;
use App\Models\Course;
use App\Models\Mark;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarkResource extends Resource
{
    protected static ?string $model = Mark::class;

    protected static ?string $navigationIcon = 'heroicon-o-check';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('course_id')
                        ->label('Course')
                        ->required()
                        ->options(Course::all()->pluck('name', 'id')->toArray())
                        ->reactive()
                        ->afterStateUpdated(fn (callable  $set) => $set('student_id', null)),
                    Select::make('student_id')
                        ->label('Name')
                        ->required()
                        ->options(function (callable $get) {
                            $course = Course::find($get('course_id'));
                            if (!$course) {
                                return Course::all()->pluck('name', 'id');
                            }
                            return $course->students->pluck('name', 'id');
                        })
                        ->reactive(),
                    TextInput::make('listening')
                        ->required()
                        ->maxLength(3),
                    TextInput::make('speaking')
                        ->required()
                        ->maxLength(3),
                    TextInput::make('reading')
                        ->required()
                        ->maxLength(3),
                    TextInput::make('writing')
                        ->required()
                        ->maxLength(3),
                    TextInput::make('overall')
                        ->required()
                        ->maxLength(3),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('student.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('listening')
                    ->sortable(),
                TextColumn::make('speaking')
                    ->sortable(),
                TextColumn::make('reading')
                    ->sortable(),
                TextColumn::make('writing')
                    ->sortable(),
                TextColumn::make('overall')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('course')->relationship('course', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            StudentRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarks::route('/'),
            'create' => Pages\CreateMark::route('/create'),
            'edit' => Pages\EditMark::route('/{record}/edit'),
        ];
    }    
}
