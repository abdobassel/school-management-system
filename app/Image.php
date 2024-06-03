<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
    // relation for more than one image => morphmany in models -- student -- teacher ----
    public function imageable()
    {
        return $this->morphTo();
    }
}
