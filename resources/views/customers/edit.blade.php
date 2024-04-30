@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Edit Customer</h1><br>
    <h2>{{ $customer->name }}</h2>
    <form action="{{ route('customers.update', $customer->customer_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $customer->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
        </div>

        <div class="form-group">
            <label for="company_name">Company Name:</label>
            <input type="text" class="form-control" name="company_name" value="{{ $customer->company_name }}">
        </div>

        <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" class="form-control" name="street" value="{{ $customer->street }}">
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value="{{ $customer->city }}">
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" class="form-control" name="state" value="{{ $customer->state }}">
        </div>

        <div class="form-group">
            <label for="zip_code">Zip Code:</label>
            <input type="text" class="form-control" name="zip_code" value="{{ $customer->zip_code }}">
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" value="{{ $customer->country }}">
        </div>

        <div class="form-group">
            <label for="notes">Notes:</label>
            <textarea class="form-control" name="notes">{{ $customer->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Customer</button>
    </form>
</div>
@endsection
