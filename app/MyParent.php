<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyParent extends Authenticatable
{
    use HasTranslations, HasApiTokens;
    public $translatable = ['name_father', 'job_father', 'name_mother', 'job_mother'];
    protected $table = 'my_parents';
    protected $guarded = [];


    public function parentsAtchments()
    {
        return $this->hasMany(ParentAtachment::class, 'parent_id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
