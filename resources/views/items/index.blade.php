@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Items List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
        @endforeach
    </table>


    <a href="{{ route('items.create') }}" class="btn btn-primary">Add New Item</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Serial Number</th>
                <th>Cobox Name</th>
                <th>Cobox ID</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->product->name }}</td> <!-- Access the product name directly from the item -->
                <td>{{ $item->item_serial_number }}</td>
                <td>{{ $item->cobox_name }}</td>
                <td>{{ $item->cobox_id }}</td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>
@endsection
