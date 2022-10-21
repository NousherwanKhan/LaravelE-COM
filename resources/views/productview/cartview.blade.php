@extends('layouts.navbar')

@section('user')
    <div class="container">
        <a href="{{ url('/') }}" type="button" class="btn btn-secondary mb-3">Back</a>
        <div class="card ">
            <div class="card-header">
                @csrf
                <h2>CART</h2>
            </div>
            @if ($carts->count() > 0)
                <div class="card-body">
                    {{-- @dd($cart->id) --}}
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        <div class="row m-2 productData">
                            <div class="col-md-2">
                                <img src="{{ asset('public/images/Product/' . $cart->products->image) }}" alt=""
                                    width="70px" height="70px">
                            </div>
                            <div class="col-md-3">
                                <h5>{{ $cart->products->name }}</h5>
                            </div>
                            <div class="col-md-2">
                                <h5> ${{ $cart->products->price }}</h5>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $cart->product_id }}" class="product_id">
                                
                                @if ($cart->products->quantity > $cart->t_qty)
                                <label>Quantity</label>
                                    <div class="input-group text-center" style="width: 120px">
                                        <button type="button" class="input-group-text changeQty decrement-btn">-</button>
                                        <input type="text" value="{{ $cart->t_qty }}" name="t_qty"
                                            class="form-control text-center qty-input">
                                        <button type="button" max={{ $cart->products->quantity}}  class="input-group-text changeQty increment-btn">+</button>
                                    </div>
                                    @php $total += $cart->products->price * $cart->t_qty; @endphp
                                @else
                                    <label class="badge bg-danger">Out of Stock</label>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <h6 class="btn btn-danger delete_cart_item"><i class="bi bi-trash"></i> Remove</h6>
                            </div>
                            <br>
                    @endforeach
                </div>
                <div class="card-footer p-3">
                    <h6> Total Price: ${{ $total }}
                        <a href="{{ route('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                    </h6>
                </div>
            @else
                <div class="card-body">
                    <h6>Your Cart is Empty, <a href="{{ url('/') }}">Continue Shopping</a> </h6>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection
