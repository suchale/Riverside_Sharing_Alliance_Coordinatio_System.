<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ShelterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $shelters = DB::select('select * from shelter');
       return $shelters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // first find all the services that a shelter can be a part of
        $services = DB::select('select * from service order by sname asc');
        return view('shelter.shelterCreate')->with('services',$services);
    }

    /**
     * Store a newly created resource in storage.
     * Handle the default value if is_null()
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // default values need to be assigned 
        if(!is_null($request->hoursOfOperation)){
        DB::insert('insert into shelter (sShelter_id,hoursOfOperation,bunkType,bunkAvailableCount,familyRoomAvailableCount,description,conditionsForUse) 
        values (:sShelter_id,:hoursOfOperation,:bunkType,:bunkAvailableCount,:familyRoomAvailableCount,:description,:conditionsForUse)', [
            'sShelter_id'=>$request->service_id,
            'hoursOfOperation'=>$request->hoursOfOperation,
            'bunkType'=>$request->bunkType,
            'bunkAvailableCount'=>$request->bunkAvailableCount,
            'familyRoomAvailableCount'=>$request->familyRoomAvailableCount,
            'description'=>$request->description,
            "conditionsForUse"=>$request->conditionsForUse
        ]);
    }
    
    else{
       DB::insert('insert into shelter (sShelter_id,bunkType,bunkAvailableCount,familyRoomAvailableCount,description,conditionsForUse) 
        values (:sShelter_id,:bunkType,:bunkAvailableCount,:familyRoomAvailableCount,:description,:conditionsForUse)', [
            'sShelter_id'=>$request->service_id,
            'bunkType'=>$request->bunkType,
            'bunkAvailableCount'=>$request->bunkAvailableCount,
            'familyRoomAvailableCount'=>$request->familyRoomAvailableCount,
            'description'=>$request->description,
            "conditionsForUse"=>$request->conditionsForUse
        ]);

    }
      return "Record Inserted"; 
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

       // get all the services but get that record which has my id as the top  
       $services = DB::select('select * from service order by service_id=:service_id desc, sName asc',[
            'service_id'=>$id
       ]); 

       $shelter = DB::select('select * from shelter where sShelter_id =:sShelter_id limit 1',[
            'sShelter_id'=>$id
       ]); 


       return view('shelter.shelterEdit')->with('services', $services)->with('shelter',$shelter);
    
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
        $affected = DB::update('update shelter set hoursOfOperation=:hoursOfOperation,
            bunkType=:bunkType,bunkAvailableCount=:bunkAvailableCount,
            familyRoomAvailableCount=:familyRoomAvailableCount,
            description=:description,conditionsForUse=:conditionsForUse where sShelter_id=:sShelter_id',[
            'sShelter_id'=>$id,
            'hoursOfOperation'=>$request->hoursOfOperation,
            'bunkType'=>$request->bunkType,
            'bunkAvailableCount'=>$request->bunkAvailableCount,
            'familyRoomAvailableCount'=>$request->familyRoomAvailableCount,
            'description'=>$request->description,
            'conditionsForUse'=>$request->conditionsForUse
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
