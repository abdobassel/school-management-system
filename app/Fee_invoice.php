<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee_invoice extends Model
{
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

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}
