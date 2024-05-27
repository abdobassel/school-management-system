<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentAtachment extends Model
{
    protected $fillable = ['parent_id', 'file_name'];
}
