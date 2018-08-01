@extends('layouts.app')
@section('title', 'New Shelter')

@section('content')
 <main>
    <div>
        <h1>Create a new Shelter</h1>
         <div class="alert alert-danger" role="alert">
            Ensure you choose the right service, it can't be edited once created!
          </div>  
	    <form method="post" action="/shelter">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="hoursOfOperation">Hours of Operation</label>
              <input type="text" class="form-control"  placeholder="default: 7PM to 7AM"  name="hoursOfOperation"><br>
              
              <label for="bunkType">Bunk Type:</label>
              <input type="text" class="form-control"  placeholder="2 letters - MM-Male, FF-Female, MF -Mixed" name="bunkType"><br>

              <label for="bunkAvailableCount">Bunk Available Count:</label>
              <input type="number" class="form-control"  placeholder="ex: 20" name="bunkAvailableCount"><br>

              <label for="familyRoomAvailableCount">Family Room Available Count:</label>
              <input type="number" class="form-control"  placeholder="ex: 2" name="familyRoomAvailableCount"><br>

              <label for="service">Choose your service:</label>             
              <select class="form-control" name="service_id">
                @foreach ($services as $service)
                  <option value="{{$service->service_id}}">{{$service->sName}}</option>  
                @endforeach
              </select><br>

              <label for="description">Bunk Description:</label>
              <textarea class="form-control"  placeholder="Describe your bunk here" name="description" rows=5></textarea> <br>

              <label for="description">Conditions for Use:</label>
              <textarea class="form-control"  placeholder="Describe conditions for use" name="conditionsForUse" rows=5></textarea> <br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection