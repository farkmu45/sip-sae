<?php

namespace App\Filament\Widgets;

use App\Enums\Role;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $teachersCount = Teacher::where('role_id', '=', Role::TEACHER->value)->count();
        $studentsCount = Student::has('user', '!=')->count();
        $usersCount = Student::has('user')->count();

        return [
            Card::make(__('text.total_teachers'), $teachersCount),
            Card::make(__('text.total_of_registered_students'), $usersCount),
            Card::make(__('text.total_of_unregistered_students'), $studentsCount),
        ];
    }
}
