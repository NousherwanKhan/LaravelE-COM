@extends('layouts.navbar')

@section('user')



<div class="container mt-5 col-6">

    <form id='Addpost' action="{{ url('update/'. $product->id) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="modal-body">

            <div class="form-group error">
                <label>Product</label>
                <input type="text" class="form-control has-error" id="name" name="name" value="{{ $product->name }}">
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Write something about Picture" id="description" value="{{ $product->description }}" name="description"
                    style="height: 100px">{{ $product->description }}</textarea>
                <label for="description" name="description">Description</label>
            </div>
            <div class="form-group error">
                <label>Price</label>
                <input type="text" class="form-control has-error" id="price" value="{{ $product->price }}" name="price">
            </div>
            <div class="form-group error">
                <label>Quantity</label>
                <input type="text" class="form-control has-error" id="quantity" value="{{ $product->quantity }}" name="quantity">
            </div>
            <div class="mb-3">
                <img src="{{ asset('public/images/Product/'. $product->image )}}" alt="img" width="50">
                <input class="form-control" type="file" id="image" value="{{ asset('public/images/Product/'. $product->image )}}" name="image">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@endsection