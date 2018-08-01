@extends('layouts.app')
@section('title', 'Edit Service')

@section('content')
 <main>
    <div>
        <h1>Edit the Service</h1>
      <form method="post" action="/service/{{$service[0]->service_id}}">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="sName">Service Name</label>
              <input type="text" class="form-control"  placeholder="Service Name" value='{{$service[0]->sName}}'  name="sName"><br>
              
              <label for="Site ID"> Site ID:</label>
              <input disabled="true" type="text" class="form-control"  placeholder="Site ID" value='{{$service[0]->site_id}}' name="site_id"><br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection