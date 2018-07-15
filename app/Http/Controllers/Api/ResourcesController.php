<?php

namespace App\Http\Controllers\Api;

use App\Model\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourcesController extends Controller
{
    public function update_resources(){
        $id = request('id');
        Resources::where('id',$id)->increment('download_count');
        return response()->json(['code'=>200]);
    }
}
