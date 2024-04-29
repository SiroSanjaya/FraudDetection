@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Customers List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    <a href="{{ route('customers.show', $customer->customer_id) }}" class="btn btn-info">View</a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
