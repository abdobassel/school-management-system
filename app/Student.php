<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use SoftDeletes;

    use HasTranslations, HasApiTokens;
    public $translatable = ['name'];
    protected $fillable = [
        'name', 'email', 'password', 'gender_id', 'nationalitiy_id', 'blood_id', 'Date_Birth', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year',
    ];
    protected $guarded = [];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول الطلاب

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    // علاقة بين الطلاب الصفوف الدراسية لجلب اسم الصف في جدول الطلاب

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalitiy_id');
    }

    // علاقة بين الطلاب الاقسام الدراسية لجلب اسم القسم  في جدول الطلاب

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }
    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');
    }
    // images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }


    protected $hidden = [
        'password', 'remember_token',
    ];
}
