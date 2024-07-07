<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quize extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }



    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function degree()
    {
        return $this->hasMany(Degree::class, 'quizze_id');
    }
}
