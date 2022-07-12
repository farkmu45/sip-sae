<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'student_nis';

    protected $fillable = [
        'name',
        'nis',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'student_nis');
    }
}
