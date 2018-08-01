<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = DB::Select('select * from family');
        return $families;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('family.familyCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into family (familyName) values(:familyName)',[
            "familyName"=>$request->familyName
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
       $family = DB::Select('select * from family where family_id=:family_id limit 1',[
            "family_id"=>$id
       ]); 
       return view('family.familyEdit')->with('family',$family);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $family = DB::Select('select * from family where family_id=:family_id limit 1',[
            "family_id"=>$id
       ]); 
        return view('family.familyEdit')->with('family',$family);
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
        
        $affected = DB::update('update family set familyName=:familyName where family_id=:family_id',[
            "familyName"=>$request->familyName,
            "family_id"=>$id

        ]);

        return "update affected ".$affected. " row(s).";

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
