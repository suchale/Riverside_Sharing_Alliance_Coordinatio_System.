@extends('layouts.app')
@section('title', 'New FoodBank')

@section('content')
 <main>
    <div>
        <h1>Create a new FoodBank</h1>
         <div class="alert alert-danger" role="alert">
            Ensure you choose the right service, it can't be edited once created!
          </div> 
	    <form method="post" action="/foodbank">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             

            <label for="Services">Service:</label><br>             
             <select class="form-control" name="sFoodBank_id">
              @foreach($services as $service)
               <option value="{{$service->service_id}}">{{$service->sName}}</option>
              @endforeach
             </select>
             <br>

            <label for="Services"> Choose a related Request to the FoodBank: (Source user_id) - (Destination user_id)</label><br>             
             <select class="form-control" name="Request_id">
              @foreach($itemRequests as $itemRequest)
               <option value="{{$itemRequest->request_id}}">{{$itemRequest->source_user_id}} - {{$itemRequest->destination_user_id}}</option>
              @endforeach
             </select>
             <br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection