<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemcategories = DB::select('select * from itemcategory');
        return $itemcategories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('itemcategory.ItemCategoryCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into itemcategory(categoryName) values (:categoryName)',[
            'categoryName'=>$request->categoryName
        ]);

        return "insert record(s).";
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
        $itemcategories = DB::select('select * from itemcategory where category_id=:category_id',[
            'category_id'=>$id
        ]);
        return view('itemcategory.ItemCategoryEdit')->with('itemcategories',$itemcategories);
        // return $itemcategories;
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
        $affected = DB::update('update itemcategory set categoryName=:categoryName where category_id=:category_id',[
                'categoryName'=>$request->categoryName,
                'category_id'=>$id
        ]);

        return "affected ".$affected. " row(s).";
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
