@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Create New Order</h1>
    <form action="{{ route('orders.storeWithItems') }}" method="POST">
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

        <div id="order-items">
            <label for="products">Products:</label>
            <div class="order-item" data-index="0">
                <div class="form-group">
                    <label for="items[0][product_id]">Product:</label>
                    <select name="items[0][product_id]" class="form-control" onchange="fetchItemDetails(this, 0)" required>
                        <option value="">Select a Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}">
                                {{ $product->name }} - ${{ number_format($product->price, 2) }} - Stock: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="itemDetails0" style="display: none;">
                    <p><strong>Serial Number:</strong> <span id="itemSerialNumber0"></span></p>
                    <p><strong>Cobox ID:</strong> <span id="itemCoboxId0"></span></p>
                </div>
                <div class="form-group">
                    <label for="items[0][quantity]">Quantity:</label>
                    <input type="number" name="items[0][quantity]" class="form-control" min="1" placeholder="Enter quantity" required>
                </div>
            </div>
        </div>

        <button type="button" id="add-item" class="btn btn-secondary">Add Another Item</button>
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

function fetchItemDetails(selectElement, index) {
    var productId = selectElement.value;
    if (!productId) {
        document.getElementById('itemDetails' + index).style.display = 'none';
        return;
    }
    fetch('/api/items/' + productId)
        .then(response => response.json())
        .then(data => {
            document.getElementById('itemSerialNumber' + index).textContent = data.serial_number;
            document.getElementById('itemCoboxId' + index).textContent = data.cobox_id;
            document.getElementById('itemDetails' + index).style.display = 'block';
        })
        .catch(error => console.error('Error fetching item details:', error));
