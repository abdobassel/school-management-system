<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Exam extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = ['name', 'academic_year', 'term'];
}
