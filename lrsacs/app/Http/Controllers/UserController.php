<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select('select * from user');
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sites = DB::select('select * from site order by shortName asc');
        return view('user.UserCreate')->with('sites',$sites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|string
     */
    public function store(Request $request)
    {
       DB::insert('insert into user (username,password,firstName,lastName,site_id) values(
        :username,:password,:firstName,:lastName,:site_id)',[
        'username'=>$request->username,
        'password'=>$request->password,
        'firstName'=>$request->firstName,
        'lastName'=>$request->lastName,
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
         $user = DB::select('select * from user where user_id=:user_id limit 1',[
            'user_id'=>$id
         ]);

         return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = DB::select('select * from user where user_id=:user_id limit 1',[
            'user_id'=>$id
         ]);

         // get all the sites but get that record which has my id as the top  
       $sites = DB::select('select * from site order by site_id=:site_id desc, shortName asc',[
            'site_id'=>$user[0]->site_id
       ]); 

        return view('user.userEdit')->with('user',$user)->with('sites',$sites);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|string
     */
    public function update(Request $request, $id)
    {
        $affected = DB::update('update user set 
        username =:username,
        password=:password,
        firstName=:firstName,
        lastName=:lastName,
        site_id=:site_id where user_id=:user_id',
        [    'user_id'=>$id,   
             'username' => $request->username,
             'password' => $request->password,
             'firstName'=>$request->firstName,
             'lastName'=>$request->lastName,
             'site_id'=>$request->site_id
        ]);

       return "update affected ".$affected." row(s).";
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
