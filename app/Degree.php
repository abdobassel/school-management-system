<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function quizze()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
