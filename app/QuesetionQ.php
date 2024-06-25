<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuesetionQ extends Model
{
    protected $table = 'qusetions';
    public function quizze()
    {
        return $this->belongsTo(Quize::class, 'quize_id');
    }
}
