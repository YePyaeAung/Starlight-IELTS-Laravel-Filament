<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\State;
use App\Models\Student;
use App\Models\Township;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->required()
                        ->maxLength(20),
                    TextInput::make('age')
                        ->required()
                        ->maxLength(3),
                    Toggle::make('paid')
                        ->inline(),
                    TextInput::make('address')
                        ->required()
                        ->maxLength(255),
                    Select::make('course_id')
                        ->relationship('course', 'name'),
                    Select::make('state_id')
                        ->label('State')
                        ->required()
                        ->options(State::all()->pluck('name', 'id')->toArray())
                        ->reactive()
                        ->afterStateUpdated(fn (callable  $set) => $set('township_id', null)),
                    Select::make('township_id')
                        ->label('Township')
                        ->required()
                        ->options(function (callable $get) {
                            $state = State::find($get('state_id'));
                            if (!$state) {
                                return Township::all()->pluck('name', 'id');
                            }
                            return $state->townships->pluck('name', 'id');
                        })
                        ->reactive(),
                    DatePicker::make('course_end_date')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('age')
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make('paid')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('course.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('township.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('state.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course_end_date')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('course')->relationship('course', 'name'),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
