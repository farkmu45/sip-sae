<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements FilamentUser
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function canAccessFilament(): bool
    {
        return true;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
