@extends('layouts.app')
@section('title', 'Edit RoomWaitList')

@section('content')
 <main>
    <div>
        <h1>Edit Room Waitlist</h1>
         <div class="alert alert-danger" role="alert">
            Ensure you choose the right Shelter Id and FamilyName, they can't be edited once created!
          </div> 
	    <form method="post" action="/roomwaitlist/{{$roomwaitList[0]->roomWaitList_id}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">

       <div class="form-group">   
          <label for="shelter">Shelter Id - BunkType: </label>
             <select class="form-control" name="shelter_id">
                @foreach ($shelters as $shelter)
                  <option value="{{$shelter->sShelter_id}}">{{$shelter->sShelter_id}} - {{$shelter->bunkType}}</option> 
                @endforeach
             </select><br>
          
            <label for="family">FamilyID - FamilyName: </label>
             <select class="form-control" name="family_id">
              @foreach ($families as $family)
                <option value="{{$family->family_id}}">{{$family->family_id}} - {{$family->familyName}}</option> 
              @endforeach
            </select><br>  

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection