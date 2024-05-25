@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Create New Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select class="form-control" name="customer_id" id="customer_id" onchange="fetchCustomerDetails()" required>
                <option value="">Select a Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="customerDetails" style="display: none;">
            <p><strong>Email:</strong> <span id="customerEmail"></span></p>
            <p><strong>Phone:</strong> <span id="customerPhone"></span></p>
            <p><strong>Address:</strong> <span id="customerAddress"></span></p>
        </div>
        
        <div class="form-group">
            <label for="user_id">Sales Person:</label>
            <select class="form-control" name="user_id" required>
                <option value="">Select a Sales Person</option>
                @foreach ($users as $user)
                    <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="point_id">Point:</label>
            <select class="form-control" name="point_id" required>
                <option value="">Select a Point</option>
                @foreach ($points as $point)
                    <option value="{{ $point->point_id }}">{{ $point->point_name }}</option>
                @endforeach
            </select>
        </div>

        <label for="products">Products:</label>
        @foreach ($products as $product)
            <div class="form-group">
                <label>{{ $product->name }} - ${{ number_format($product->price, 2) }} - Stock: {{ $product->stock }}</label>
                <input type="number" name="quantities[{{ $product->product_id }}]" class="form-control" value="0" min="0" max="{{ $product->stock }}" placeholder="Enter quantity">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>
<script>
function fetchCustomerDetails() {
    var customerId = document.getElementById('customer_id').value;
    if (!customerId) {
        document.getElementById('customerDetails').style.display = 'none';
        return;
    }
    fetch('/api/customers/' + customerId)
        .then(response => response.json())
        .then(data => {
            document.getElementById('customerEmail').textContent = data.email;
            document.getElementById('customerPhone').textContent = data.phone;
            document.getElementById('customerAddress').textContent = data.address;
            document.getElementById('customerDetails').style.display = 'block';
        })
        .catch(error => console.error('Error fetching customer details:', error));
}
</script>
@endsection
