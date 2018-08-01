@extends('layouts.app')
@section('title', 'New Family')

@section('content')
 <main>
    <div>
        <h1>Create a new Family</h1>
       <div class="alert alert-danger" role="alert">
        Ensure you provide a unique family name!
      </div>  
	    <form method="post" action="/family">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             

            <label for="familyName">Family Name</label>
            <input type="text" class="form-control"  placeholder="Enter a unique name"  name="familyName"><br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection