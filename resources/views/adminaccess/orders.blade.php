@extends('layouts.navbar')

@section('user')
    <!-- Add Modal -->

    <div class="container">

        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h2 class="justify-content-between"> Orders</h2>

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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach ($orderitems as $item)
                                            <tr>
                                                <td>{{ $item->order_id }}</td>
                                                <td>{{$item->order->buyer->name }}</td>
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

                                                <td>
                                                    @if ($item->order->status == \App\Models\Order::PENDING)
                                                        <a href="{{ url('deliver/' . $item->order_id) }}"
                                                            class="edit btn btn-info btn-sm editItem">Deliver</a>
                                                    @else
                                                        <a href="" class="edit btn btn-info btn-sm" disabled>Deliver</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endsection
