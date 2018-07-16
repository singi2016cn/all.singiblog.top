<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Feedbacks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request_data = $request->except('_token');
        $this->validate($request,[
            'content'=>'required|string:1023'
        ]);
        //邮箱/手机号/QQ/微信/微博
        if (Validator::make($request->only('contact'),['contact'=>'email'])->passes()){
            $request_data['type'] = 1;
        } elseif(Validator::make($request->only('contact'),['contact'=>['regex:/^1(3|4|5|7|8)\d{9}$/']])->passes()){
            $request_data['type'] = 2;
        } else{
            $request_data['type'] = 3;
        }
        Feedbacks::firstOrCreate($request_data);
        return back()->with('status', '感谢您的反馈，我们会尽快做出响应！');
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
