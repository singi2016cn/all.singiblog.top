<?php

namespace App\Http\Controllers\Backend;

use App\Model\Crosswords;
use App\Model\CrosswordsCounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrosswordsController extends Controller
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
        $data = Crosswords::orderBy('id','desc')->paginate('10');
        return view('backend.crosswords.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $crosswords_counts = CrosswordsCounts::orderBy('id','desc')->get();
        return view('backend/crosswords/create',['ns'=>[0,10,20,30,40,50,60,70,80,90],'crosswords_counts'=>$crosswords_counts]);
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
            'crosswords_counts_id'=>'required|min:1',
            'word'=>'required|string:255',
            'tip'=>'required|string:255',
            'cell_ids'=>'required|array',
            'seq'=>'required|string:15'
        ]);
        $crosswords = $request->except('_token');
        $crosswords['cell_ids'] = implode(',',$crosswords['cell_ids']);
        Crosswords::create($crosswords);
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
        return view('backend.crosswords.show')->with('item',Crosswords::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.crosswords.edit')->with('item',Crosswords::findOrFail($id));
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
                'word'=>'required|string:255',
                'tip'=>'required|string:255',
                'is_h'=>'required',
                'seq'=>'required|string:15'
            ]);
            $request_data = $request->except(['_token','_method']);
            Crosswords::where('id',$id)->update($request_data);
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
        Crosswords::destroy($id);
        return redirect()->route('backend.crosswords.index')->with('status','delete success,id = '.$id);
    }
}
