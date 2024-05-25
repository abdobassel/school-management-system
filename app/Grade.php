<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model
{
    //
    use HasTranslations;
    public $translatable = ['name'];
    public $timstamps = true;
    protected $fillable = ['notes', 'name'];


    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'grade_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }
}
