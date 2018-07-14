<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Crosswords extends Model
{
    protected $guarded = ['id'];

    public function crosswordsCounts(){
        return $this->belongsTo(CrosswordsCounts::class);
    }
}
