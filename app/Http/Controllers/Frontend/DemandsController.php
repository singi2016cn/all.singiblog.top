<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Demands;
use App\Http\Controllers\Config\DemandsConfig;

class DemandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $object = Demands::orderBy('id','desc');
        $search = $request->input('search');
        if ($search) $object->where('name','like',"%{$search}%");
        $type = $request->input('type');
        if ($type) $object->where('type',$type);
        $platform = $request->input('platform');
        if ($platform) $object->where('platform',$platform);
        $data = $object->paginate(10);
        return view('frontend.demands.index',[
            'type_setting'=>DemandsConfig::$type_settings,
            'platform_setting'=>DemandsConfig::$platform_settings,
            'search'=>$search,
            'type'=>$type,
            'platform'=>$platform,
        ])->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.demands.create',['type_setting'=>DemandsConfig::$type_settings, 'platform_setting'=>DemandsConfig::$platform_settings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string:255',
            'description'=>'required',
            'type'=>'required|min:1',
            'platform'=>'required|min:1'
        ]);
        $request_data = $request->except('_token');
        Demands::firstOrCreate($request_data);
        return back()->with('status', '发布成功');
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
