<?php

namespace App\Http\Controllers\Backend;

use App\Model\Resources;
use App\Http\Controllers\Frontend\ResourcesController as Rc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.resources.index',['data'=>Resources::orderBy('id','desc')->paginate(10),'type_setting'=>Rc::$type_setting,'is_free_setting'=>Rc::$is_free_setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.resources.create',['type_setting'=>Rc::$type_setting,'is_free_setting'=>Rc::$is_free_setting]);
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
            'name'=>'required|string:255|unique:resources',
            'type'=>'required',
            'download_link'=>'required|string:255',
        ]);
        $request_data = $request->except('_token');
        $validator = Validator::make($request->only('download_link'), [
            'download_link' => 'required|url',
        ]);
        if ($validator->fails()){
            $download_link_arr = explode(' ',$request_data['download_link']);
            if ($download_link_arr[1]) $request_data['download_link'] = $download_link_arr[1];
            if ($download_link_arr[3]) $request_data['download_password'] = $download_link_arr[3];
        }
        Resources::firstOrCreate($request_data);
        return back()->with('status', 'create success');
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
        return view('backend.resources.edit',['item'=>Resources::findOrFail($id),'type_setting'=>Rc::$type_setting,'is_free_setting'=>Rc::$is_free_setting]);
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
        $this->validate($request,[
            'name'=>'required|string:255',
            'type'=>'required',
            'download_link'=>'required|string:255',
        ]);
        $request_data = $request->except(['_token','_method']);
        Resources::where('id',$id)->update($request_data);
        return back()->with('status','update success,id = '.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resources::destroy($id);
        return redirect()->route('backend.resources.index')->with('status','delete success,id = '.$id);
    }
}
