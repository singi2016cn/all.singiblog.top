<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Demands;

class DemandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function find(Request $request){
        $id = $request->input('id',0);
        if ($id < 0) return response()->json(['status'=>404,'msg'=>'not found']);
        return response()->json(['status'=>200,'data'=>Demands::where('id',$id)->value('description')]);
    }
}
