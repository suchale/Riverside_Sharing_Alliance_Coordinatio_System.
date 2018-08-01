@extends('layouts.app')
@section('title', 'Edit FoodBank')

@section('content')
 <main>
    <div>
        <h1>Edit FoodBank</h1>
         <div class="alert alert-danger" role="alert">
            Remember: Can't edit service - Also, if your update becomes a duplicate entry after edit, it won't be updated. 
          </div> 
	    <form method="post" action="/foodbank/{{$foodbank[0]->sFoodBank_id}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">

          <div class="form-group">   
             
            <label for="Services">Service:</label><br>             
             <select class="form-control" name="sFoodBank_id" disabled="true">
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