@extends('layouts.app')
@section('title', 'New FoodBank Inventory')

@section('content')
 <main>
    <div>
        <h1>Create a new FoodBank Inventory</h1>
         <div class="alert alert-danger" role="alert">
            Ensure you choose the right foodbank and Item, it can't be edited once created!
          </div> 
	    <form method="post" action="/foodbankinventory">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             

            <label for="Services">Choose Foodbank:(Foodbank id) - (Request id)</label><br>             
             <select class="form-control" name="sFoodBank_id">
              @foreach($foodbanks as $foodbank)
               <option value="{{$foodbank->sFoodBank_id}}">{{$foodbank->sFoodBank_id}} - {{$foodbank->Request_id}}</option>
              @endforeach
             </select>
             <br>

             <label for="ItemCount">Item count:</label>
             <input type="number" class="form-control"  placeholder="# Item Units" value="1"  name="ItemCount"><br>

            <label for="Item_id"> Choose Item: </label><br>             
             <select class="form-control" name="Item_id">
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