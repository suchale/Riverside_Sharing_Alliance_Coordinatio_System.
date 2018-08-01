<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=DB::select('select * from client');
        return $clients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $families = DB::select('select * from family');
        return view('client.clientCreate')->with('families',$families);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into client (firstName,lastName,is_head,govtIDNumber,govtIDTypeDesc,ContactNumber,family_id,personality) 
            values (:firstName,:lastName,:is_head,:govtIDNumber,:govtIDTypeDesc,:ContactNumber,:family_id,:personality)',[
                "firstName"=>$request->firstName,
                "lastName"=>$request->lastName,
                "is_head"=>$request->is_head,
                "govtIDNumber"=>$request->govtIDNumber,
                "govtIDTypeDesc"=>$request->govtIDTypeDesc,
                "ContactNumber"=>$request->ContactNumber,
                "family_id"=>$request->family_id,
                "personality"=>$request->personality,
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
        
        $client = DB::select('select * from client where client_id=:client_id limit 1',[
            "client_id"=>$id
        ]);


        $families = DB::select('select * from family order by family_id=:family_id desc',[
            "family_id"=>$client[0]->family_id
        ]);

        return view('client.clientEdit')->with('client',$client)->with('families',$families);
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
       
       $affected =  DB::update('update client set firstName=:firstName,
                                lastName=:lastName,
                                is_head=:is_head,
                                govtIDNumber=:govtIDNumber,
                                govtIDTypeDesc=:govtIDTypeDesc,
                                ContactNumber=:ContactNumber,
                                family_id=:family_id,
                                personality=:personality where client_id=:client_id',[
                                    "firstName"=>$request->firstName,
                                    "lastName"=>$request->lastName,
                                    "is_head"=>$request->is_head,
                                    "govtIDNumber"=>$request->govtIDNumber,
                                    "govtIDTypeDesc"=>$request->govtIDTypeDesc,
                                    "ContactNumber"=>$request->ContactNumber,
                                    "family_id"=>$request->family_id,
                                    "personality"=>$request->personality,
                                    "client_id"=>$id
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
