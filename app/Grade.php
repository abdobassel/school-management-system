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
}
