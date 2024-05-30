@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Create New Order</h1>
    <form action="{{ route('orders.store') }}" method="POST" id="order-form">
        @csrf
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select class="form-control" name="customer_id" id="customer_id" onchange="fetchSalesPerson()" required>
                <option value="">Select a Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">Sales Person:</label>
            <select class="form-control" name="user_id" id="user_id" required>
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

        <div id="order-products">
            <label for="products">Products:</label>
            <div class="order-product" data-index="0">
                <div class="form-group">
                    <label for="products[0][product_id]">Product:</label>
                    <select name="products[0][product_id]" class="form-control" required>
                        <option value="">Select a Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}">
                                {{ $product->name }} - ${{ number_format($product->price, 2) }} - Stock: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="products[0][quantity]">Quantity:</label>
                    <input type="number" name="products[0][quantity]" class="form-control" min="1" placeholder="Enter quantity" required>
                </div>
            </div>
        </div>

        <button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>

<script>
function fetchSalesPerson() {
    var customerId = document.getElementById('customer_id').value;
    if (!customerId) {
        document.getElementById('user_id').value = '';
        return;
    }
    fetch('/api/customers/' + customerId)
        .then(response => response.json())
        .then(data => {
            document.getElementById('user_id').value = data.sales_person_id; // Assuming the API returns a sales_person_id field
        })
        .catch(error => console.error('Error fetching sales person:', error));
}

document.getElementById('add-product').addEventListener('click', function() {
    var orderProductsDiv = document.getElementById('order-products');
    var currentIndex = orderProductsDiv.querySelectorAll('.order-product').length;
    var newProductDiv = document.createElement('div');
    newProductDiv.className = 'order-product';
    newProductDiv.dataset.index = currentIndex;
    newProductDiv.innerHTML = `
        <div class="form-group">
            <label for="products[${currentIndex}][product_id]">Product:</label>
            <select name="products[${currentIndex}][product_id]" class="form-control" required>
                <option value="">Select a Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">
                        {{ $product->name }} - ${{ number_format($product->price, 2) }} - Stock: {{ $product->stock }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="products[${currentIndex}][quantity]">Quantity:</label>
            <input type="number" name="products[${currentIndex}][quantity]" class="form-control" min="1" placeholder="Enter quantity" required>
        </div>
    `;
    orderProductsDiv.appendChild(newProductDiv);
});
</script>
@endsection
