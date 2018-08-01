@extends('layouts.app')
@section('title', 'Edit Family')

@section('content')
 <main>
    <div>
        <h1>Edit Family</h1>
       <div class="alert alert-danger" role="alert">
        Ensure you provide a unique family name!
      </div>  
	    <form method="post" action="/family/{{$family[0]->family_id}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">

          <div class="form-group">   
            <label for="familyName">Family Name</label>
            <input type="text" class="form-control" value="{{$family[0]->familyName}}" placeholder="Enter a unique name"  name="familyName"><br>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection