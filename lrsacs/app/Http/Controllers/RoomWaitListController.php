<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class RoomWaitListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomwaitlists = DB::Select('select * from roomwaitlist');
        return $roomwaitlists;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shelters = DB::select('select * from shelter');
        $families = DB::select('select * from family');
        return view('roomwaitlist.roomwaitlistCreate')->with('shelters',$shelters)
        ->with('families',$families);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into roomwaitlist (shelter_id,family_id) values(:shelter_id,:family_id)',[
            "shelter_id"=>$request->shelter_id,
            "family_id"=>$request->family_id
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomwaitList = DB::select('select * from roomwaitlist where roomWaitList_id=:roomWaitList_id',[
            "roomWaitList_id"=>$id
        ]);

        $shelters = DB::select('select * from shelter order by sShelter_id=:sShelter_id desc',[
            "sShelter_id"=>$roomwaitList[0]->shelter_id
        ]);

        $families=DB::select('select * from family order by family_id=:family_id desc',[
            "family_id"=>$roomwaitList[0]->family_id
        ]);

        return view('roomwaitlist.roomwaitlistEdit')->with('roomwaitList',$roomwaitList)
        ->with('shelters',$shelters)->with('families',$families);
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
    
        $affected = DB::update('update roomwaitlist set shelter_id=:shelter_id,
            family_id=:family_id where roomWaitList_id=:roomWaitList_id',[

                "shelter_id"=>$request->shelter_id,
                "family_id"=>$request->family_id,
                "roomWaitList_id"=>$id
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
