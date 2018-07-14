<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CrosswordsCounts extends Model
{
    protected $guarded = ['id'];

    public function crosswords(){
        return $this->hasMany(Crosswords::class,'crosswords_counts_id','id');
    }
}
