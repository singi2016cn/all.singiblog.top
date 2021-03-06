<?php

namespace App\Http\Controllers\Backend;

use App\Model\Crosswords;
use App\Model\CrosswordsCounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrosswordsCountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.backend:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CrosswordsCounts::orderBy('id','desc')->paginate(10);
        return view('backend/crosswords_counts/index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/crosswords_counts/create');
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
            'des'=>'required|string:255'
        ]);
        $request_data = $request->except('_token');
        CrosswordsCounts::firstOrCreate($request_data);
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
        return view('backend.crosswords_counts.show')->with('item',CrosswordsCounts::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.crosswords_counts.edit')->with('item',CrosswordsCounts::findOrFail($id));
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
        if ($id > 0){
            $this->validate($request,[
                'des'=>'required|string:255'
            ]);
            $request_data = $request->except(['_token','_method']);
            CrosswordsCounts::where('id',$id)->update($request_data);
            return back()->with('status','update success,id = '.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id > 0){
            $data = Crosswords::where('crosswords_counts_id',$id)->first();
            if ($data) return back()->with('alert_tpl','error')->with('status','delete fail,because it has one more relation records exist on Crosswords');
            CrosswordsCounts::destroy($id);
            return redirect()->route('backend.crosswords_counts.index')->with('status','delete success! id = '.$id);
        }
    }

    public function crosswords_create($id){
        return view('backend.crosswords_counts.crosswords_create')->with('ns',[0,10,20,30,40,50,60,70,80,90])->with('item',CrosswordsCounts::findOrFail($id));
    }
}
