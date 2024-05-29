<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    //
    use HasTranslations;
    public $translatable = ['name'];
    public $timstamps = true;
    protected $fillable = ['name'];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'specialization_id');
    }
}
