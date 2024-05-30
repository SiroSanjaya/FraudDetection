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
                <th>Cobox ID</th>
                <th>Generate QR Code</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->product->name }}</td> <!-- Access the product name directly from the item -->
                <td>{{ $item->item_serial_number }}</td>
                <td>{{ $item->cobox_id }}</td>
                <td><a href="{{ route('items.qr-code', ['serialNumber' => $item->item_serial_number, 'productType' => $item->product_id, 'coboxId' => $item->cobox_id]) }}" class="btn btn-primary" target="_blank">Generate QR Code</a></td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>
@endsection
