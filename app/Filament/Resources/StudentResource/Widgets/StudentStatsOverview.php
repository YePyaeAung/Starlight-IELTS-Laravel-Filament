<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StudentStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Students', Student::all()->count()),
            Card::make('Yangon Students', Student::where('state_id', '1')->count()),
            Card::make('Mandalay Students', Student::where('state_id', '3')->count()),
        ];
    }
}
