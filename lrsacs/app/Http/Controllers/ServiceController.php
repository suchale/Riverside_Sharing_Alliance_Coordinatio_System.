<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $services = DB::select('select * from service');
       return $services;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = DB::select('select * from site');
        return view('service.serviceCreate')->with('sites',$sites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      DB::insert('insert into service (sName,site_id) 
        values (:sName,:site_id)', [
            'sName'=>$request->sName,
            'site_id'=>$request->site_id
        ]);

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
       $service = DB::select('select * from service where service_id =:service_id',[
            'service_id'=>$id
       ]); 

       return view('service.serviceEdit')->with('service', $service);
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
        $affected = DB::update('update service set sName=:sName where service_id=:service_id',[
                'sName'=>$request->sName,
                'service_id'=>$id
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
        // If all the services are going to be deleted, don't allow the last one to be deleted.
        // strategy:  If a given site_id has less than 2 services, then don't delete any service associated 
        // with that site.

       $counts_sites =  DB::select('SELECT COUNT(*) as "Services", site_id FROM service GROUP BY(site_id) HAVING(services<2)');     

       if(counts_sites[0]->)


    }
}
