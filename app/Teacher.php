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



    public function genders()
    {
        $this->hasMany(Gender::class, 'gender_id');
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class, 'specialization_id');
    }
}
