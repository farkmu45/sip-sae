<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $teachersCount = Teacher::count();
        $studentsCount = Student::has('user', '!=')->count();
        $usersCount = Student::has('user')->count();

        return [
            Card::make(__('text.total_teachers'), $teachersCount),
            Card::make(__('text.total_of_registered_students'), $studentsCount),
            Card::make(__('text.total_of_unregistered_students'), $usersCount),
        ];
    }
}
