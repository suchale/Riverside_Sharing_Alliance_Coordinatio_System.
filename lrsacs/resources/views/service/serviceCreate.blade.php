@extends('layouts.app')
@section('title', 'New Service')

@section('content')
 <main>
    <div>
        <h1>Create a new Service</h1>
	    <form method="post" action="/service">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="sName">Service Name</label>
              <input type="text" class="form-control"  placeholder="Service Name"  name="sName"><br>

              <label for="site">Site: </label>
               <select class="form-control" name="site_id">
                @foreach ($sites as $site)
                  <option value="{{$site->site_id}}">{{$site->shortName}}</option> 
                @endforeach
              </select><br> 

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection