<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentAtachment extends Model
{
    protected $fillable = ['parent_id', 'file_name'];




    public function myParent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }
}
