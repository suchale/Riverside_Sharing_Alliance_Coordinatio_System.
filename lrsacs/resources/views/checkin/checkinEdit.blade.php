@extends('layouts.app')
@section('title', 'Edit Check-In')

@section('content')
 <main>
    <div>
        <h1>Edit Check In</h1>
	    <form method="post" action="/checkin/{{$checkin[0]->CheckIn_id}}">
      <input type="hidden" name="_method" value="PUT">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">   
             
              <label for="client"> Client:</label><br>             
               <select class="form-control" name="client_id">
                @foreach($clients as $client)
                 <option value="{{$client->client_id}}">{{$client->firstName}}</option>
                @endforeach
               </select>
               <br>

               <label for="user"> User Name:</label><br>             
               <select class="form-control" name="user_id">
                @foreach($users as $user)
                 <option value="{{$user->user_id}}">{{$user->firstName}}</option>
                @endforeach
               </select>
               <br>

              <label for="service"> Service Name:</label><br>             
               <select class="form-control" name="service_id">
                @foreach($services as $service)
                 <option value="{{$service->service_id}}">{{$service->sName}}</option>
                @endforeach
               </select>
               <br>

              <label for="description">Description</label>
              <textarea class="form-control"  placeholder="Describe the check-in."  name="Description" rows="5">{{$checkin[0]->Description}}</textarea><br>
 
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection