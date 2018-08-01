@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
 <main>
    <div>
        <h1>Edit the User</h1>
	    <form method="post" action="/user/{{$user[0]->user_id}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" name="_method" value="PUT">

          <div class="form-group">   
             <label for="username"> UserName: </label>
              <input type="text" class="form-control" value="{{$user[0]->username}}"  name="username"><br>
              
              <label for="password"> Password: </label>
              <input type="text" class="form-control"  value="{{$user[0]->password}}" name="password"><br>
              
              <label for="firstName"> FirstName: </label>
              <input type="text"  class="form-control"  value="{{$user[0]->firstName}}" name="firstName"><br>
                    
              <label for="LastName">LastName:</label>
              <input type="text"  class="form-control"  value="{{$user[0]->lastName}}" name="lastName"><br>
      
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