<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = [''];
    protected $primaryKey = 'nis';

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::parse($attributes['date_of_birth'])->age,
        );
    }

    protected function ageMonth(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $studentDOB =  Carbon::parse($attributes['date_of_birth']);
                $currentDate = Carbon::parse(now());
                $studentDOBConverted = $studentDOB->year($currentDate->year);
                $monthDifference = $currentDate->diffInMonths($studentDOBConverted);

                return $monthDifference;
            },
        );
    }


    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function measurements()
    {
        return $this->hasMany(NutritionMeasurement::class, 'student_nis');
    }
}
