<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use App\Models\Course;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CourseStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Course', Course::all()->count()),
            Card::make('IELTS Students', Student::where('course_id', '1')->count()),
            Card::make('GED Students', Student::where('course_id', '2')->count()),
        ];
    }
}
