@extends('layouts.app')
@section('title', 'Edit FoodBank Inventory')

@section('content')
 <main>
    <div>
        <h1>Edit FoodBank Inventory</h1>
         <div class="alert alert-info" role="alert">
            Remember: Foodbank and Item can't be edited once created! (Refer to the E-R diagram).
          </div> 
	    <form method="post" action="/foodbankinventory/{{$foodbankInventory[0]->sFoodBank_id}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" name="_method" value="PUT">

          <div class="form-group">   
             

            <label for="Services" disabled="true">Choosen Foodbank:(Foodbank id) - (Request id)</label><br>             
             <select class="form-control" name="sFoodBank_id" disabled="true">
              @foreach($foodbanks as $foodbank)
               <option value="{{$foodbank->sFoodBank_id}}">{{$foodbank->sFoodBank_id}} - {{$foodbank->Request_id}}</option>
              @endforeach
             </select>
             <br>

             <label for="ItemCount">Item count:</label>
             <input type="number" class="form-control"  placeholder="# Item Units" value="{{$foodbankInventory[0]->ItemCount}}" name="ItemCount"><br>

            <label for="Item_id"> Choosen Item: </label><br>             
             <select class="form-control" disabled="true" name="Item_id">
              @foreach($items as $item)
               <option value="{{$item->Item_id}}">{{$item->name}}</option>
              @endforeach
             </select>
             <br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection