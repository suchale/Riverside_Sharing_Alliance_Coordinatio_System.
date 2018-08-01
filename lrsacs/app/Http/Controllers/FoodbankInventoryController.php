<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FoodbankInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodbankInventories=DB::select('select * from foodbank_inventory');
        return $foodbankInventories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodbanks = DB::select('select * from foodbank');
        $items = DB::select('select * from item');
        return view('FoodbankInventory.foodbankInventoryCreate')->with('foodbanks',$foodbanks)
        ->with('items',$items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('insert into foodbank_inventory (Item_id, ItemCount,sFoodBank_id) values (:Item_id,:ItemCount,:sFoodBank_id)',[
            "Item_id"=>$request->Item_id,
            "ItemCount"=>$request->ItemCount,
            "sFoodBank_id"=> $request->sFoodBank_id
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
        
        $foodbankInventory = DB::select('select * from foodbank_inventory where sFoodBank_id=:sFoodBank_id',[
            "sFoodBank_id"=>$id
        ]);

        // get the already chosen record from the database
        $foodbanks= DB::select('select * from foodbank order by sFoodBank_id=:sFoodBank_id',[
            "sFoodBank_id"=>$foodbankInventory[0]->sFoodBank_id
        ]);

        $items = DB::select('select * from item order by Item_id=:Item_id',[
            "Item_id"=>$foodbankInventory[0]->Item_id
        ]);
        
        return view('foodbankInventory.foodbankInventoryEdit')->with('foodbanks',$foodbanks)
        ->with('items',$items)->with('foodbankInventory',$foodbankInventory);
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
         $foodbankInventory = DB::select('select * from foodbank_inventory where sFoodBank_id=:sFoodBank_id',[
            "sFoodBank_id"=>$id
        ]);

        $affected = DB::update('update foodbank_inventory set ItemCount=:ItemCount where sFoodBank_id =:sFoodBank_id and Item_id=:Item_id',[
            "ItemCount"=>$request->ItemCount,
            "sFoodBank_id"=> $id,
            "Item_id"=> $foodbankInventory[0]->Item_id
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
