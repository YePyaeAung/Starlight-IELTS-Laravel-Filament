<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\State;
use App\Models\Township;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $recordTitleAttribute = 'name';

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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
