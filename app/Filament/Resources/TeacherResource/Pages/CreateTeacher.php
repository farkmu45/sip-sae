<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Enums\Role;
use App\Filament\Resources\TeacherResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role_id'] = Role::TEACHER->value;

        return $data;
    }
}
