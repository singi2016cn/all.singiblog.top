<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sentences extends Model
{
    protected $guarded = ['id'];

    function getTagAttribute($value){
        return explode(',',$value);
    }
}
