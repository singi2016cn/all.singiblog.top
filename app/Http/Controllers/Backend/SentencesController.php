<?php

namespace App\Http\Controllers\Backend;

use App\Model\Sentences;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SentencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.sentences.index',['data'=>Sentences::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sentences.create');
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
            'title'=>'required|string:255'
        ]);
        $request_data = $request->except('_token');
        Sentences::firstOrCreate($request_data);
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
        return view('backend.sentences.show')->with('item',Sentences::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.sentences.edit')->with('item',Sentences::findOrFail($id));
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
            'title'=>'required|string:255'
        ]);
        $request_data = $request->except(['_token','_method']);
        Sentences::where('id',$id)->update($request_data);
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
        Sentences::destroy($id);
        return redirect()->route('backend.sentences.index')->with('status','delete success,id = '.$id);
    }
}
