<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Narration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::updated(function (Narration $model) {
            if ($model->picture != $model->getOriginal('picture')) {
                Storage::delete('public/' . $model->getOriginal('picture'));
            }
        });

        static::deleted(fn (Narration $model) => Storage::delete('public/' . $model->picture));
    }
}
