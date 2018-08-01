@extends('layouts.app')
@section('title', 'Edit FoodPantry')

@section('content')
 <main>
    <div>
        <h1>Edit the FoodPantry</h1>
	    <form method="post" action="/foodpantry/{{$foodpantry[0]->sFoodPantry_id}}">
      <input type="hidden" name="_method" value="PUT">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             

            <label for="Services">Associated Service (Can't Edit):</label><br>
             <select class="form-control" name="service_id" disabled="true">
              @foreach($services as $service)
               <option value="{{$service->service_id}}">{{$service->sName}}</option>
              @endforeach
             </select>
             <br>

             <label for="description">Food Pantry Description</label><br>
             <textarea class="form-control" name="description" rows=5>{{$foodpantry[0]->description}}</textarea> <br>


              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection