<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    public function viewAny(Teacher $user)
    {
        return $user->role->name == Role::ADMIN->value;
    }

    public function view(Teacher $user, Teacher $teacher)
    {
        return false;
    }

    public function create(Teacher $user)
    {
        return $user->role->name == Role::ADMIN->value;
    }

    public function update(Teacher $user, Teacher $teacher)
    {
        return $user->role->name == Role::ADMIN->value;
    }

    public function delete(Teacher $user, Teacher $teacher)
    {
        return $user->role->name == Role::ADMIN->value;
    }

    public function restore(Teacher $user, Teacher $teacher)
    {
        return $user->role->name == Role::ADMIN->value;
    }

    public function deleteAny(Teacher $user)
    {
        return $user->role->name == Role::ADMIN->value;
    }
}
