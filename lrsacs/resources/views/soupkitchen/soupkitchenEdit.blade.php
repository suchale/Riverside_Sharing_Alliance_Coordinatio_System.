@extends('layouts.app')
@section('title', 'Edit SoupKitchen')

@section('content')
 <main>
    <div>
        <h1>Edit SoupKitchen</h1>
         <div class="alert alert-danger" role="alert">
            Remember : Once you choose the service, you can't edit!
          </div> 
  
	    <form method="post" action="/soupkitchen/{{$soupkitchen[0]->sSoupKitchen_id}}">
       <input type="hidden" name="_method" value="PUT">
  	    <input type="hidden" name="_token" value="{{csrf_token()}}">

          <div class="form-group">   

             <label for="Services">Service:</label><br>
             <select class="form-control" name="service_id" disabled="true">
              @foreach($services as $service)
               <option value="{{$service->service_id}}">{{$service->sName}}</option>
              @endforeach
             </select>
             <br>
             
             <label for="description">SoupKitchen Description:</label><br>
             <textarea class="form-control" placeholder="Describe your SoupKitchen here" name="Description" rows=5>{{$soupkitchen[0]->Description}}</textarea> <br>


              <label for="totalSeatAvailable">Seats Available:</label><br>
              <input type="number" value="{{$soupkitchen[0]->totalSeatAvailable}}" class="form-control"  placeholder="Enter Total Available seats" name="totalSeatAvailable"></input> <br>

              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection