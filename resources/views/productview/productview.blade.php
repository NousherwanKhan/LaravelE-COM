@extends('layouts.navbar')


@section('content')


    <div class="container">
        <div class="row">

            @foreach ($products as $product)
                <div class="m-2 col-md-3">
                    <div class="card" style="width: 21rem;">
                        <img class="img-thumbnail"
                            src="{{ asset('public/images/Product/' . $product->image) }}"
                            alt="{{ $product->user->name }}'s.img" style="height: 25vh">
                        <div class="card-body bg-light">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>PRICE: </b>{{ $product->price }}</li>
                            <li class="list-group-item"><b>QUANTITY: </b>{{ $product->quantity }}</li>
                            <li class="list-group-item"><b>LISTED BY: </b> {{ $product->user->name }}</li>
                        </ul>
                        <div class="card-body bg-light">
                            <a href="{{ url('product/' . $product->id) }}" class="card-link btn btn-info float-left">View
                                Product</a>
                        </div>
                    </div>
                    <div class="mb-5"></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
