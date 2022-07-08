<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NutritionMeasurement extends Model
{
    protected $guarded = ['id', 'height_in_meters'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_nis');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(NutritionalStatus::class, 'nutritional_status_id');
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function (NutritionMeasurement $nutritionMeasurement) {
            $nutritionMeasurement->imt = self::calculateIMT($nutritionMeasurement);
            $zscore = self::calculateZscore($nutritionMeasurement);
            $nutritionMeasurement->nutritional_status_id = self::measureStatus($zscore);
        });
    }

    private static function calculateIMT(NutritionMeasurement $nutritionMeasurement): float
    {
        $height = $nutritionMeasurement->height / 100;
        $weight = $nutritionMeasurement->weight;
        return round($weight / pow($height, 2), 3);
    }

    private static function calculateZscore(NutritionMeasurement $nutritionMeasurement): float
    {
        $anthropometry = null;
        $zscore = null;
        $student = $nutritionMeasurement->student;

        $whereClause = [
            ['year', '=', $student->age],
            ['month', '=', $student->ageMonth]
        ];

        if ($student->gender == Gender::MALE->value) {
            $anthropometry = MaleAnthropometry::where($whereClause)->first();
        } else {
            $anthropometry = FemaleAnthropometry::where($whereClause)->first();
        }

        $topCalculation = $nutritionMeasurement->imt - $anthropometry->median;

        if ($topCalculation < 0) {
            $zscore = $topCalculation / ($anthropometry->median - $anthropometry['-1sd']);
        } else {
            $zscore = $topCalculation / ($anthropometry['+1sd'] - $anthropometry->median);
        }

        return $zscore;
    }

    private static function measureStatus(float $zscore): int
    {
        switch ($zscore) {
            case $zscore < -3:
                return 1;
                break;
            case $zscore >= -3 && $zscore < -2:
                return 2;
                break;
            case $zscore >= -2 && $zscore <= 1:
                return 3;
            case $zscore > 1 && $zscore <= 2:
                return 4;
            case $zscore > 2:
                return 5;
        }
    }
}
