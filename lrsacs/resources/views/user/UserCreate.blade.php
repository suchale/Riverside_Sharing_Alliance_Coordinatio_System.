@extends('layouts.app')
@section('title', 'New User')

@section('content')
 <main>
    <div>
        <h1>Create a new User</h1>
	    <form method="post" action="/user">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="username"> UserName: </label>
              <input type="text" class="form-control"  placeholder="Username"  name="username"><br>
              
              <label for="password"> Password: </label>
              <input type="text" class="form-control"  placeholder="Password" name="password"><br>
              
              <label for="firstName"> FirstName: </label>
              <input type="text"  class="form-control"  placeholder="Firstname" name="firstName"><br>
                    
              <label for="LastName">LastName:</label>
              <input type="text"  class="form-control"  placeholder="LastName" name="lastName"><br>
      
               <label for="site">Site:</label>
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