@extends('layouts.app')
@section('title', 'New Client')

@section('content')
 <main>
    <div>
        <h1>Create a new Client</h1>
	    <form method="post" action="/client">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             
              <label for="firstName">First Name</label>
              <input type="text" class="form-control"  placeholder="Mandatory FirstName"  name="firstName"><br>

              <label for="lastName">Last Name</label>
              <input type="text" class="form-control"  placeholder="LastName"  name="lastName"><br>

              <label for="ishof">Head of the Family?</label>
              <input type="boolean" class="form-control"  placeholder="0 if Not, 1 if Yes" value="0"  name="is_head"><br>

              <label for="govtIDNumber">Govt ID Number:</label>
              <input type="text" class="form-control"  placeholder="Enter ID Number"  name="govtIDNumber"><br>
        
              <label for="govtIDTypeDesc">Govt ID Type Describe (Maybe expiry or changes, etc.):</label>
              <textarea class="form-control"  placeholder="ID Type"  name="govtIDTypeDesc"></textarea><br>

              <label for="ContactNumber">Contact Number:</label>
              <input type="text" class="form-control"  placeholder="Enter Number"  name="ContactNumber"><br>

              <label for="Family"> Family Name:</label><br>             
               <select class="form-control" name="family_id">
                @foreach($families as $family)
                 <option value="{{$family->family_id}}">{{$family->familyName}}</option>
                @endforeach
               </select>
               <br>

              <label for="personality">Personality</label>
              <textarea class="form-control"  placeholder="Describe any characters related to the client's personality that users need to be aware about."  name="personality" rows="5"></textarea><br>
 
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection