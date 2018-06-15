<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Crosswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CrosswordsCounts;

class CrosswordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend/crosswords/index',['crosswords_counts'=>CrosswordsCounts::paginate(10)]);
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
        $crosswords_counts = CrosswordsCounts::findOrFail($id);
        $crosswords = Crosswords::where('crosswords_counts_id',$id)->get()->toArray();
        $cell_exist_ids = [];
        $cell_b_exist_ids = [];
        $cell0_exist_ids = [];
        $crosswords_h = [];
        $crosswords_v = [];
        if ($crosswords){
            foreach($crosswords as &$crossword){
                if ($crossword['cell_ids']){
                    $cell_ids_arr = explode(',',$crossword['cell_ids']);
                    $crossword['cell_ids'] = $cell_ids_arr;
                    $cell_exist_ids = array_merge($cell_exist_ids,$cell_ids_arr);

                    if ($crossword['is_h'] == 1){
                        $cell_b_ids_arr = [$cell_ids_arr[0]];
                        $cell_b_exist_ids = array_merge($cell_b_exist_ids,$cell_b_ids_arr);
                        $crosswords_h[] = $crossword;
                    }else{
                        $cell0_ids_arr = [$cell_ids_arr[0]];
                        $cell0_exist_ids = array_merge($cell0_exist_ids,$cell0_ids_arr);
                        $crosswords_v[] = $crossword;
                    }
                }
            }
            unset($crossword);
        }
        $cell_exist_ids = array_unique($cell_exist_ids);
        return view('frontend/crosswords/show',['crosswords_counts'=>$crosswords_counts,'crosswords'=>json_encode($crosswords),'crosswords_v'=>json_encode($crosswords_v),'crosswords_h'=>json_encode($crosswords_h),'cell_exist_ids'=>$cell_exist_ids,'cell0_exist_ids'=>$cell0_exist_ids,'cell_b_exist_ids'=>$cell_b_exist_ids]);
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

    /**
     * 提交填字表单，获取成绩
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request){
        return response()->json($request->all());
    }
}
