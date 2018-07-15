<?php

namespace App\Http\Controllers\frontend;

use App\Model\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourcesController extends Controller
{
    public static $type_setting = [
        1 => '图书',
        2 => '游戏',
        3 => '电影',
        4 => '电视剧',
        5 => '动漫',
        6 => '软件',
        7 => '小说',
        8 => '系统',
    ];

    public static $is_free_setting = [
        1 => '免费',
        2 => '收费',
    ];

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources_object = Resources::orderBy('id','desc');
        $search = $request->input('search');
        if ($search) $resources_object->where('name','like',"%{$search}%");
        $type = $request->input('type');
        if ($type) $resources_object->where('type',$type);
        $is_free = $request->input('is_free');
        if ($is_free) $resources_object->where('is_free',$is_free);
        $data = $resources_object->paginate(10);
        return view('frontend/resources/index',['data'=>$data,'type_setting'=>self::$type_setting,'is_free_setting'=>self::$is_free_setting,'search'=>$search,'type'=>$type,'is_free'=>$is_free]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
