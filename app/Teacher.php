<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['name'];
    public $timstamps = true;
    protected $fillable = ['name', 'email', 'password', 'gender_id', 'specialization_id', 'joined_date', 'adderss'];



    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    // Define the relationship with Specialization
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_teacher');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
