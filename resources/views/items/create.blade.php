@extends('admin.layout.layout')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h1>Add New Item</h1>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Product:</label>
            <select class="form-control" name="product_id" required>
                <option value="" selected disabled>Please Select a Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Cobox Name:</label>
            <select class="form-control" name="cobox_name" required>
                <option value="" selected disabled>Select Cobox Type</option>
                @foreach ($coboxNames as $coboxName)
                    <option value="{{ $coboxName }}">{{ $coboxName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Quantity:</label>
            <input type="number" class="form-control" name="quantity" required>
        </div>
        <input type="hidden" name="is_available" value="1">
        <button type="submit" class="btn btn-primary">Create Item</button>
    </form>
</div>
@endsection
