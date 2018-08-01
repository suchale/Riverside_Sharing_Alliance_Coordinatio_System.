@extends('layouts.app')
@section('title', 'Edit Item Category')

@section('content')
 <main>
    <div>
        <h1>Edit Item Category</h1>
	    <form method="post" action="/itemcategory/{{$itemcategories[0]->category_id}}">
      <input type="hidden" name="_method" value="PUT">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="category">Category Name</label>
              <input type="text" class="form-control" placeholder="Ex: Food, Personal Hygiene, Clothing, Shelter" value="{{$itemcategories[0]->categoryName}}"  name="categoryName"><br>
              
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection