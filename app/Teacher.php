<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
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
}
