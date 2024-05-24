<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    //
    use HasTranslations;
    public $translatable = ['name'];
    public $timstamps = true;
    protected $fillable = ['name', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
