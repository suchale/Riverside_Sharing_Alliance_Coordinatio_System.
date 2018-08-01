<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FoodPantryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $foodpantries = DB::select('select * from foodpantry');
         return $foodpantries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $services = DB::select('select * from service');
        return view('foodpantry.foodPantryCreate')->with('services',$services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       DB::insert('insert into foodpantry (sFoodPantry_id,description) 
        values (:sFoodPantry_id,:description)', [
            'sFoodPantry_id'=>$request->service_id,
            'description'=>$request->description
        ]);

      return "Record Inserted"; 

        // return $request->all();
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

        $services = DB::select('select * from service order by service_id=:service_id desc, sName asc',[
            'service_id'=>$id
        ]);

        $foodpantry = DB::select('select * from foodpantry where sFoodPantry_id =:sFoodPantry_id',[
            'sFoodPantry_id'=>$id
        ]);
        return view('foodpantry.foodPantryEdit')->with('services',$services)->with('foodpantry',$foodpantry);
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
        $affected = DB::update('update foodpantry set description=:description where sFoodPantry_id=:sFoodPantry_id',[
            'sFoodPantry_id'=>$id,
            'description'=>$request->description
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
