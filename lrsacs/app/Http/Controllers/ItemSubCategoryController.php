<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ItemSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemSubCategories = DB::select('select * from itemsubcategory');
        return $itemSubCategories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = DB::select('select * from itemcategory order by categoryName asc'); 
       return view('itemsubcategory.itemSubCategoryCreate')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into itemsubcategory (category_id,name) values(:category_id,:name)',[
            "category_id"=>$request->category_id,
            "name"=>$request->name
        ]);

        return "inserted record(s).";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $itemSubCategory = DB::select('select * from itemsubcategory where subCategory_id=:subCategory_id limit 1',[
            "subCategory_id"=>$id
        ]);

        return $itemSubCategory;  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $itemSubCategory = DB::select('select * from itemsubcategory where subCategory_id=:subCategory_id limit 1',[
            "subCategory_id"=>$id
        ]);

        $categories = DB::select('select * from itemcategory order by category_id=:category_id,categoryName asc',[
            "category_id"=>$id
        ]);
        // return $itemSubCategory;
        return view('itemsubcategory.itemsubcategoryEdit')->with('itemSubCategory',$itemSubCategory)->with('categories',$categories);
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

        $affected = DB::update('update itemsubcategory set name=:name,category_id=:category_id where subCategory_id =:subCategory_id',[
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'subCategory_id'=>$id
        ]);

        return "affected ".$affected. " row(s).";
        return $request->all();

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
