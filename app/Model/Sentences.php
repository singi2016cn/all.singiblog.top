<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sentences extends Model
{
    protected $guarded = [];

    function getTagAttribute($value){
        return explode(',',$value);
    }
}
