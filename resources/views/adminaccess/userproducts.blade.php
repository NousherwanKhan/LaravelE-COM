@extends('layouts.navbar')

@section('admin')
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
                        <h1>Admin's Pannel</h1>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Product</th>
                                            <th>Price</th>
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
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    @if ($product->status == \App\Models\Product::PENDING)
                                                        <span class="label label-primary">Pending</span>
                                                    @elseif($product->status == \App\Models\Product::APPROVED)
                                                        <span class="label label-success">Approved</span>
                                                    @else($product->status == \App\Models\Product::REJECTED)
                                                        <span class="label label-danger">Rejected</span>
                                                    @endif

                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($product->status == \App\Models\Product::PENDING)
                                                        <a href="{{ url('accept/' . $product->id) }}"
                                                            class="edit btn btn-info btn-sm editItem">Accept</a>
                                                        <a
                                                            href="{{ url('reject/' . $product->id) }}"class="btn btn-danger btn-sm deleteItem">Reject</a>
                                                    @else
                                                        <a href="{{ url('accept/' . $product->id) }}"
                                                            class="edit btn btn-info btn-sm editItem" disabled>Accept</a>
                                                        <a href="{{ url('reject/' . $product->id) }}"class="btn btn-danger btn-sm deleteItem"
                                                            disabled>Reject</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <div class="container mb-2 col-3"> {!! $products->appends(\Request::except('links'))->render() !!} </div> --}}

                                </table>
                                {{-- {{ $products->links() }} --}}
                            @endsection
