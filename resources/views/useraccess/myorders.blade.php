@extends('layouts.navbar')

@section('user')
    <!-- Add Modal -->

    <div class="container">
        <a href="{{ url('/upload') }}" type="button" class="btn btn-secondary mb-3">Back</a>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h2 class="justify-content-between">
                            {{ Auth::user()->name }}'s Orders</h2>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Buyer</th>
                                            <th>Product ID</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach ($orderitems as $item)
                                            <tr>
                                                <td>{{ $item->order_id }}</td>
                                                <td>{{ Auth::user()->name }}</td>
                                                <td>{{ $item->product_id }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    @if ($item->order->status == \App\Models\Order::PENDING)
                                                        <span class="label label-primary">Pending</span>
                                                    @elseif($item->order->status == \App\Models\Order::DELIVERED)
                                                        <span class="label label-success">Delivered</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endsection
