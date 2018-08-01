<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FoodBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodbanks = DB::select('select * from foodbank');
        return $foodbanks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = DB::select('select * from service');
        $itemRequests = DB::select('select * from request');
        return view('foodbank.foodBankCreate')->with('services',$services)->with('itemRequests',$itemRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       DB::insert('insert into foodbank (sFoodBank_id,Request_id) values(:sFoodBank_id,:Request_id)',[
            "sFoodBank_id"=>$request->sFoodBank_id,
            "Request_id"=>$request->Request_id,
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
        $foodbank = DB::select('select * from foodbank where sFoodBank_id=:sFoodBank_id',[
            "sFoodBank_id"=>$id
        ]);

        $services = DB::select('select * from service order by service_id=:service_id desc, sName asc',[
            "service_id"=>$foodbank[0]->sFoodBank_id
        ]);

        $itemRequests =  DB::select('select * from request order by request_id=:request_id desc, request_id asc',[
            "request_id"=>$foodbank[0]->Request_id
        ]); 

        return view('foodbank.foodbankEdit')->with('foodbank',$foodbank)->
        with('services',$services)->with('itemRequests',$itemRequests);

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
       $affected = DB::update('update foodbank set Request_id=:Request_id where sFoodBank_id=:sFoodBank_id',[
            "Request_id"=>$request->Request_id,
            "sFoodBank_id"=>$id
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
