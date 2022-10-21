@extends('layouts.navbar')

@section('user')
    <!-- Add Modal -->
    <div class="modal fade" id="AddTableModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>-
            @endif
            <!-- Add Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id='Addpost' action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group error">
                            <label>Product</label>
                            <input type="text" class="form-control has-error" id="name" name="name">
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Write something about Picture" id="description" name="description"
                                style="height: 100px"></textarea>
                            <label for="description" name="description">Description</label>
                        </div>
                        <div class="form-group error">
                            <label>Price</label>
                            <input type="text" class="form-control has-error" id="price" name="price">
                        </div>
                        <div class="form-group error">
                            <label>Quantity</label>
                            <input type="text" class="form-control has-error" id="quantity" name="quantity">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h2 class="justify-content-between">
                            {{ Auth::user()->name }}'s Wall
                            <!-- Trigger the modal with a button -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-lg float-left" data-toggle="modal"
                                data-target="#AddTableModal">Add Product</button>
                                <a href="{{ route('myorders') }}" class="btn btn-primary"> My Orders </a>
                        </h2>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->user->name }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td> <img src="{{ asset('public/images/Product/' . $product->image) }}"
                                                        alt="" width="50"></td>
                                                <td>
                                                    @if ($product->status == \App\Models\Product::PENDING)
                                                        <span class="label label-primary">Pending</span>
                                                    @elseif($product->status == \App\Models\Product::APPROVED)
                                                        <span class="label label-success">Approved</span>
                                                    @else($product->status == \App\Models\Product::STATUS_REJECED)
                                                        <span class="label label-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->status !== \App\Models\Product::REJECTED)
                                                        <a href="{{ url('edit/' . $product->id) }}"
                                                            class="edit btn btn-primary btn-sm editItem">Edit</a>
                                                    @else
                                                        <a href="" class="edit btn btn-primary btn-sm editItem"
                                                            disabled>Edit</a>
                                                    @endif
                                                    <a
                                                        href="{{ url('delete/' . $product->id) }}"class="btn btn-danger btn-sm deleteItem">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endsection
