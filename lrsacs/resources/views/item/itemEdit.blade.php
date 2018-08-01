@extends('layouts.app')
@section('title', 'Edit Item')

@section('content')
 <main>
    <div>
        <h1>Edit Item</h1>
	    <form method="post" action="/item/{{$item[0]->Item_id}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">

          <div class="form-group">   
             <label for="name">Item Name</label>
              <input type="text" class="form-control"  value="{{$item[0]->name}}" placeholder="Item Name"  name="name"><br>

              <label for="numberOfUnits">Number of Units</label>
              <input type="number" class="form-control" value="{{$item[0]->numberOfUnits}}" placeholder="# Item Units" value="1"  name="numberOfUnits"><br>

              <label for="expirationDate">Expiration date</label>
              <input type="date" class="form-control" value="{{$item[0]->expirationDate}}" placeholder="choose expiration date"  name="expirationDate"><br>
              
              <label for="subcategoryName">Subcategory Name</label>             
               <select id="subcategory" name="subCategory_id" class="form-control">
                @foreach($subcategories as $subcategory)
                 <option value="{{$subcategory->subCategory_id}}">{{$subcategory->name}}</option>
                @endforeach 
               </select><br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection