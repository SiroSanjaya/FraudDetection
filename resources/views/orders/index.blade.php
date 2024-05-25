@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Orders List</h1>
    <div class="mb-2">
        <a href="{{ route('orders.create') }}" class="btn btn-success">Add New Order</a>
        <!-- Sorting Links -->
        <a href="{{ route('orders.index', ['sort' => 'latest']) }}" class="btn btn-outline-secondary">Sort by Latest</a>
        <a href="{{ route('orders.index', ['sort' => 'oldest']) }}" class="btn btn-outline-secondary">Sort by Oldest</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Sales Person</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer->name ?? 'No Customer' }}</td>
                <td>{{ $order->user->username ?? 'No Sales Person' }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->order_date }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
    