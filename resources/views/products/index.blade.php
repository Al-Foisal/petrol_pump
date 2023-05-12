@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}
                    <div class="card-header">
                        <div class="pull-left">
                            <h2>Products</h2>
                        </div>
                        <div class="pull-right">
                            @can('product-create')
                                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Fuel Amount(L)</th>
                                <th>Status</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <img style="width: 50px;" src="{{ asset($product->image) }}" alt="">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>৳{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @can('product-edit')
                                                <a class="btn btn-primary"
                                                    href="{{ route('products.edit', $product->id) }}">Edit</a>
                                            @endcan


                                            @csrf
                                            @method('DELETE')
                                            @can('product-delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
