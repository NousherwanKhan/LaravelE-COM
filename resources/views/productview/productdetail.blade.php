@extends('layouts.navbar')


@section('content')

    <div class="container">
        <a href="{{ url('/') }}" type="button" class="btn btn-secondary">Back</a>

        <div class="row mt-5 card-shadow productData">
            @csrf
            @foreach ($product as $product)
                <div class="col-md-6">
                    <img src="{{ asset('public/images/Product/' . $product->image) }}" alt="" width="90%"
                        height="90%">
                </div>

                <div class="col-md-5">
                    <h1>{{ $product->name }}</h1>
                    <br>
                    <p class="fs-5">{{ $product->description }}</p>
                    <br>
                    <br>
                    <input type="hidden" value="{{ $product->id }}" class="prod_id">
                    {{-- <input type="hidden" value="{{ $product->buyer_id }}" class="buyr_id"> --}}
                    <label>Price: ${{ $product->price }}</label>
                    @if ($product->quantity > 0)
                        <label class="badge bg-success">In Stock</label>
                        @else
                        <label class="badge bg-danger">Out of Stock</label>
                    @endif
                    <div class="row mt-2">
                        @if ($product->quantity > 0)              
                        <label>Quantity</label>
                        <div class="input-group text-center" style="width: 120px">
                            <button type="button" class="input-group-text decrement-btn">-</button>
                            <input type="text" value="1" name="t_qty" class="form-control text-center qty-input">
                            <button type="button" max={{ $product->quantity}} class="input-group-text increment-btn">+</button>
                        </div>
                        {{-- @else
                        <label class="badge bg-danger">Out of Stock</label> --}}
                    @endif
                    </div>
                       <br>
                       @if ($product->quantity > 0)
                        <button type="button" class="btn btn-warning float-left addToCartBtn">Add to Cart <i
                            class="bi bi-cart4"></i>
                        </button>
                        @else
                        <button type="button" class="btn btn-warning float-left addToCartBtn" disabled>Add to Cart <i
                            class="bi bi-cart4"></i>
                        </button>
                        @endif

                </div>
            @endforeach

        </div>


    </div>
@endsection
