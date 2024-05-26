<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{

    public $timstamps = true;
    protected $fillable = ['name'];
}
