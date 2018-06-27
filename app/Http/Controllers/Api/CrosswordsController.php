<?php

namespace App\Http\Controllers\Api;

use App\Model\Crosswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrosswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.backend:admin');
    }

    public function get_crosswords(){
        $id = request('id');
        $crosswords = Crosswords::where('crosswords_counts_id',$id)->get();
        return response()->json(['code'=>200,'data'=>$crosswords]);
    }

    public function del_crosswords(){
        $id = request('id');
        $crosswords = Crosswords::where('id',$id)->delete();
        return response()->json(['code'=>200,'data'=>$crosswords]);
    }
}
