@extends('admin.layout.layout')

@section('content')
    <h1>Order Details</h1>
    <p>Order ID: {{ $order->order_id }}</p>
    <p>Customer ID: {{ $order->customer_id }}</p>
    <p>Order Date: {{ $order->order_date }}</p>

    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Serial Number</th>
                <th>Cobox Name</th>
                <th>Cobox ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->item_id }}</td>
                    <td>{{ optional($item->product)->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->item_serial_number }}</td>
                    <td>{{ $item->cobox_name }}</td>
                    <td>{{ $item->cobox_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
