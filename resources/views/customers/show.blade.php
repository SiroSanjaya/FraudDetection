@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Customer Details: {{ $customer->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
            <p><strong>Company:</strong> {{ $customer->company_name }}</p>
            <p><strong>Address:</strong> {{ $customer->street }}, {{ $customer->city }}, {{ $customer->state }}, {{ $customer->zip_code }}, {{ $customer->country }}</p>
            <p><strong>Farm Type:</strong> {{ $customer->farm_type }}</p>
            <p><strong>Assigned To:</strong> {{ $customer->assignedUser->name ?? 'Not assigned' }}</p>
            <p><strong>Notes:</strong> {{ $customer->notes }}</p>
            <!-- Add more fields as necessary -->

            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
