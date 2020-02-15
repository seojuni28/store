@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Managements</h3>
                    <a href="{{route('product.create')}}" class="btn btn-primary float-right">Add Product <i class="fas fa-edit"></i></a>
                </div>
                <div class="card-body">
                    @if(session('alert'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{session('alert')}}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product's Name</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Last update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td align="center"><img src="{{ asset('img/products/' . $product->photo) }}" alt="{{ $product->name }}" width="50px" height="50px"></td>
                                        <td><sup class="label label-success">({{ $product->code }})</sup>
                                            <strong>{{ ucfirst($product->name) }}</strong></td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td>Rp. {{number_format($product->price)}}</td>
                                        <td>{{date('d F Y',strtotime($product->update_at))}}</td>
                                        <td>
                                            <form action="{{route('product.destroy',$product->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-sm btn-primary">edit</a>
                                                <button class="btn btn-sm btn-danger" type="submit">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Data</td>
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