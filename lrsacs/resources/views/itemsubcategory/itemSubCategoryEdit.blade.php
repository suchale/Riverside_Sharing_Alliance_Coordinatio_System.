@extends('layouts.app')
@section('title', 'Edit Item SubCategory')

@section('content')
 <main>
    <div>
        <h1>Edit Item Sub Category</h1>
	    <form method="post" action="/itemsubcategory/{{$itemSubCategory[0]->category_id}}">
      <input type="hidden" name="_method" value="PUT">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">   
             <label for="category">Category Name : </label>
              <select class="form-control" name="category_id">
                @foreach($categories as $category)
                <option value="{{$category->category_id}}">{{$category->categoryName}}</option>
                @endforeach
              </select><br>

              <label for="category">SubCategory Name :</label>
              <input type="text" class="form-control" value="{{$itemSubCategory[0]->name}}"  placeholder="Ketchup, Ice, Ragged clothes, etc."  name="name"><br>

              
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>                                                            
        </form>
    </div>
</main>
@endsection