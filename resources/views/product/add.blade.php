@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Addnew Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product's Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product's Code</label>
                                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror">
                                        @error('code')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product's Stock</label>
                                        <input type="text" maxlength="10" name="stock" class="form-control @error('stock') is-invalid @enderror">
                                        @error('stock')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product's Descryption</label>
                                        <textarea type="text" name="descryption" rows="4" class="form-control @error('descryption') is-invalid @enderror"></textarea>
                                        @error('descryption')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product's Price</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product's Category</label>
                                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product's Photo</label>
                                        <div class="container form-control p-0 @error('photo') is-invalid @enderror" id="image-container">
                                        <label id="label-button" onclick="inputImage()">CHOOSE PHOTO</label>
                                            <img alt="image-preview" style="display:none;" id="image-preview" class="form-control">
                                        </div>
                                        @error('photo')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="form-control btn btn-primary mr-3 ml-3">SAVE <i class="fas fa-paper-plane"></i></button>
                            </div>
                            <input type="file" style="display:none;" name="photo" id="image-source" onchange="previewImage()">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection