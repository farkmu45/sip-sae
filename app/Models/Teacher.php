<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable implements FilamentUser
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'nip';

    protected $guarded = ['email'];

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public function role(): string
    // {
    //     return $this->belongsTo(Role::class)->name;
    // }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
