@extends('layouts.app')
@section('title', 'New SoupKitchen')

@section('content')
 <main>
    <div>
        <h1>Create a new SoupKitchen</h1>
         <div class="alert alert-danger" role="alert">
            Ensure you choose the right service, it can't be edited once created!
          </div> 
  
	    <form method="post" action="/soupkitchen">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   

             <label for="Services">Service:</label><br>
             <select class="form-control" name="service_id">
              @foreach($services as $service)
               <option value="{{$service->service_id}}">{{$service->sName}}</option>
              @endforeach
             </select>
             <br>
             
             <label for="description">Food Pantry Description:</label><br>
             <textarea class="form-control"  placeholder="Describe your SoupKitchen here" name="Description" rows=5></textarea> <br>


              <label for="totalSeatAvailable">Seats Available:</label><br>
              <input type="number" class="form-control"  placeholder="Enter Available seats" name="totalSeatAvailable"></input> <br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection