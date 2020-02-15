@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Add Category</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route('category.store')}}">
              @csrf
              <div class="form-group mb-2">
                <label class="mr-3">Category's name </label>
                <input type="text" name="name" placeholder="Enter name here.." class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label class="mr-3">Category's descryption </label>
                <textarea name="descryption" placeholder="Enter descryption here.." class="form-control @error('name') is-invalid @enderror"></textarea>
                @error('descryption')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
                <button type="submit" class="btn btn-primary mb-2 ">Add Category <i class="fas fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
              <h3 class="card-title">Category Managements</h3>
          </div>
          @if (session('alert'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{session('alert')}}</h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="myTable">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Descryption</th>
                          <th>Created at</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($categories as $category)
                          <tr>
                              <td>{{$category->name}}</td>
                              <td>{{$category->descryption}}</td>
                              <td>{{date('d F Y',strtotime($category->created_at))}}</td>
                              <td>
                                  <form action="{{route('category.destroy',$category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-primary">edit <div class="fas fa-edit"></div></a>
                                    <button type="submit" class="btn btn-sm btn-danger">delete <i class="fas fa-trash"></i></button>
                                  </form>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="4" class="text-center">No Data</td>
                          </tr>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>     
  </div>
</div>
@endsection