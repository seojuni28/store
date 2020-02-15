@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route('category.update',$category->id)}}">
              @csrf
              @method('PUT')
              <div class="form-group mb-2">
                <label class="mr-3">Category's name </label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label class="mr-3">Category's descryption </label>
                <textarea name="descryption" class="form-control @error('name') is-invalid @enderror">{{$category->descryption}} </textarea>
                @error('descryption')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
                <button type="submit" class="btn btn-primary mb-2 ">Add Category <i class="fas fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>  
  </div>
</div>
@endsection