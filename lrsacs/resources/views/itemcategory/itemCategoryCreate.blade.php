@extends('layouts.app')
@section('title', 'New Item Category')

@section('content')
 <main>
    <div>
        <h1>Create a new Item Category</h1>
	    <form method="post" action="/itemcategory">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="category">Category Name</label>
              <input type="text" class="form-control"  placeholder="Ex: Food, Personal Hygiene, Clothing, Shelter"  name="categoryName"><br>
              
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection