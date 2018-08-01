<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkins = DB::select('select * from checkin');
        return $checkins;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = DB::select('select * from client');
        $users = DB::select('select * from user'); 
        $services = DB::select('select * from service');
        return view('checkin.checkinCreate')->with('clients',$clients)->
        with('users',$users)->with('services',$services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into checkin (client_id,user_id,service_id,Description) values(:client_id,:user_id,:service_id,:Description)',[
            "client_id"=>$request->client_id,
            "user_id"=>$request->user_id,
            "service_id"=>$request->service_id,
            "Description"=>$request->Description
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
        $checkin = DB::select('select * from checkin where CheckIn_id=:CheckIn_id',[
            "CheckIn_id"=>$id
        ]);

        $clients = DB::select('select * from client order by client_id=:client_id',[
            "client_id"=>$checkin[0]->client_id
        ]);
        $users = DB::select('select * from user order by user_id=:user_id',[
            "user_id"=>$checkin[0]->user_id
        ]); 
        $services = DB::select('select * from service order by service_id=:service_id',[
            "service_id"=>$checkin[0]->service_id
        ]);
        return view('checkin.checkinEdit')->with('checkin',$checkin)
        ->with('clients',$clients)->
        with('users',$users)->with('services',$services);
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
        $affected = DB::update('update checkin set client_id=:client_id,user_id=:user_id,service_id=:service_id,Description=:Description where CheckIn_id=:CheckIn_id',[
            "client_id"=>$request->client_id,
            "user_id"=>$request->user_id,
            "service_id"=>$request->service_id,
            "Description"=>$request->Description,
            "CheckIn_id"=>$id
        ]);

        return "update affected " .$affected." row(s)."; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {                                                       
        DB::table('checkin')->where('CheckIn_id', '=', $id)->delete();
    }
}
