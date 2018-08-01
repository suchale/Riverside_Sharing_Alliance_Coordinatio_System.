<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items  = DB::select('select * from item');
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = DB::select('select * from itemsubcategory');
        return view('item.itemCreate')->with('subcategories',$subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //get the category id from the subcategory
        $category_id = DB::select('select category_id from itemsubcategory where subCategory_id=:subCategory_id',[
            'subCategory_id'=>$request->subCategory_id
        ]);

        // insert records
        DB::insert('insert into item (name,numberOfUnits,expirationDate,subCategory_id,category_id) values(:name,:numberOfUnits,:expirationDate,:subCategory_id,:category_id)',[
            "name"=>$request->name,
            "numberOfUnits"=>$request->numberOfUnits,
            "expirationDate"=>$request->expirationDate,
            "subCategory_id"=>$request->subCategory_id,
            "category_id"=>$category_id[0]->category_id
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
       $item = DB::select('select * from item where Item_id=:Item_id',[
            "Item_id" => $id
       ]);

       $subcategories = DB::select('select * from itemsubcategory order by subCategory_id=:subCategory_id desc, name asc',[
            "subCategory_id" =>$item[0]->subCategory_id
       ]);
       return view('item.itemEdit')->with('item',$item)->with('subcategories',$subcategories);
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
        $affected = DB::update('update item set name=:name,
            numberOfUnits=:numberOfUnits,
            expirationDate=:expirationDate,
            subCategory_id=:subCategory_id where Item_id=:Item_id',[
                "name"=>$request->name,
                "numberOfUnits"=>$request->numberOfUnits,
                "expirationDate"=>$request->expirationDate,
                "subCategory_id"=>$request->subCategory_id,
                "Item_id"=>$id
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
