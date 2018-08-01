@extends('layouts.app')
@section('title', 'New Request')

@section('content')
 <main>
    <div>
        <h1>Create a new Request</h1>
	    <form method="post" action="/request">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <div class="form-group">   
          <label for="Source User">Source User (username) - LastName, FirstName: </label>
             <select class="form-control" name="source_user_id">
                @foreach ($users as $user)
                  <option value="{{$user->user_id}}">{{$user->username}} - {{$user->lastName}}, {{$user->firstName}}</option>  
                @endforeach
             </select><br>
          
            <label for="Destination User">Destination User(username) - LastName, FirstName: </label>
             <select class="form-control" name="destination_user_id">
              @foreach ($users as $user)
                <option value="{{$user->user_id}}">{{$user->username}} - {{$user->lastName}}, {{$user->firstName}}</option>  
              @endforeach
            </select><br>  


            <label for="status"> Request Status(set to 0 default):</label>
            <input type="number" class="form-control" placeholder="0 - Not completed" value="0" name="status"><br>

            <label for="chooseItem">Choose which item to request: </label>
             <select class="form-control" name="Item_id">
              @foreach ($items as $item)
                <option value="{{$item->Item_id}}">{{$item->name}}</option>  
              @endforeach
            </select><br>  


            <label for="RequestedItemCount">Requested Item Count:</label>
            <input type="number" class="form-control" value="1" placeholder="Required Items count: " name="RequestedItemCount"><br>

            <label for="ItemsProvidedCount">Items Provided Counts(set to 0 default):</label>
            <input type="number" class="form-control" value="0" placeholder="Items Provided Count: " name="ItemsProvidedCount"><br>  


              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection