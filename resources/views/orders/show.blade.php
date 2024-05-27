@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order ID: {{ $order->order_id }}</h5>
            <p class="card-text"><strong>Customer Name:</strong> {{ $order->customer->name }}</p>
            <p class="card-text"><strong>Sales Person:</strong> {{ $order->user->username }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $order->status }}</p>
            <p class="card-text"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

            <h5>Items Ordered</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Serial Number</th>
                        <th>Cobox ID</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product_id }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->serial_number }}</td>
                        <td>{{ $item->cobox_id }}</td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
            <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-primary">Edit Order</a>
        </div>
    </div>
</div>
@endsection
