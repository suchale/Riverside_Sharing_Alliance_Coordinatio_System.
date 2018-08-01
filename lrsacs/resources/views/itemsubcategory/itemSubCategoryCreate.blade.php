@extends('layouts.app')
@section('title', 'New Item SubCategory')

@section('content')
 <main>
    <div>
        <h1>Create a new Item Sub Category</h1>
	    <form method="post" action="/itemsubcategory">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="category">Category Name : </label>
              <select class="form-control" name="category_id">
                @foreach($categories as $category)
                <option value="{{$category->category_id}}">{{$category->categoryName}}</option>
                @endforeach
              </select><br>

              <label for="category">SubCategory Name :</label>
              <input type="text" class="form-control"  placeholder="Ketchup, Ice, Ragged clothes, etc."  name="name"><br>

              
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection