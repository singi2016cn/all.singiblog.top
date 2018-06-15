<?php

namespace App\Http\Controllers\Api;

use App\Model\Crosswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrosswordsController extends Controller
{
    public function get_crosswords(){
        $id = request('id');
        $crosswords = Crosswords::where('crosswords_counts_id',$id)->get();
        return response()->json(['code'=>200,'data'=>$crosswords]);
    }
}
