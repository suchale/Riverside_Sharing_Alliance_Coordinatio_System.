<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = DB::select('select * from site');

        // return view('site.siteAll')->with('sites',$sites);
        return $sites;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('site.siteCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into site (shortName,addressLine1,addressLine2,city,state,zipcode,phoneNumber) values (:shortName,:addressLine1,:addressLine2,:city,:state,:zipcode,:phoneNumber)', 
            ['shortName' => $request->shortName,
             'addressLine1' => $request->addressLine1,
             'addressLine2'=>$request->addressLine2,
             'city'=>$request->city,
             'state' =>$request->state,
             'zipcode'=>$request->zipcode,
             'phoneNumber'=>$request->phoneNumber]);
        
        return "Added record to db!";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $results = DB::select('select * from site where site_id = :site_id limit 1', ['site_id' => $id]);
        return $results;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $foundSite = DB::select('select * from site where site_id =:site_id limit 1',['site_id'=>$id]);
         return view('site.siteEdit')->with('foundSite',$foundSite);
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
       $affected = DB::update('update site set shortName =:shortName,
        addressLine1=:addressLine1,
        addressLine2=:addressLine2,
        city=:city,
        state=:state,
        zipcode=:zipcode,
        phoneNumber=:phoneNumber where site_id=:site_id', 
        [    'shortName' => $request->shortName,
             'addressLine1' => $request->addressLine1,
             'addressLine2'=>$request->addressLine2,
             'city'=>$request->city,
             'state' =>$request->state,
             'zipcode'=>$request->zipcode,
             'phoneNumber'=>$request->phoneNumber,
             'site_id'=>$id
        ]);

       return "updated affected ".$affected." row(s).";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // $deleted = DB::delete('delete from users where user_id=:user_id',['user_id'=>$id]);
        // return "delete affected ".$deleted." row(s).";

        return "Inside the delete route";
    }
}
