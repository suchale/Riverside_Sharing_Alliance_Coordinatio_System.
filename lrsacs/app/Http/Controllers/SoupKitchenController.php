<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SoupKitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $soupKitchens = DB::select('select * from soupkitchen');
       return $soupKitchens;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = DB::select('select * from service');
        return view('soupkitchen.soupKitchenCreate')->with('services',$services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
       DB::insert('insert into soupkitchen (sSoupKitchen_id, Description, totalSeatAvailable) 
        values(:sSoupKitchen_id, :Description, :totalSeatAvailable)',[
        "sSoupKitchen_id"=>$request->service_id,
        "Description"=>$request->Description,
        "totalSeatAvailable"=>$request->totalSeatAvailable
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
        $soupkitchen = DB::select('select * from soupkitchen where sSoupKitchen_id=:sSoupKitchen_id limit 1',[
            "sSoupKitchen_id"=>$id
        ]); 

        $services = DB::select('select * from service order by service_id=:service_id desc',[
            "service_id"=>$soupkitchen[0]->sSoupKitchen_id
        ]);

        return view('soupkitchen.soupkitchenEdit')->with('soupkitchen',$soupkitchen)->with('services',$services);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $affected = DB::update('update soupkitchen set Description=:Description, 
            totalSeatAvailable=:totalSeatAvailable where sSoupKitchen_id=:sSoupKitchen_id',[
            "Description"=>$request->Description,
            "totalSeatAvailable"=>$request->totalSeatAvailable,
            "sSoupKitchen_id"=>$id
        ]);

       return "update affected ".$affected. " rows";

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
