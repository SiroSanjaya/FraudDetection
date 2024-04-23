@extends('layout.layout')

@section('content')
<div class="container">
    <h1>Add New Lead</h1>
    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="salutation">Salutation</label>
            <select name="salutation" class="form-control">
                <option value="Bapak">Bapak</option>
                <option value="Ibu">Ibu</option>
                <option value="-" selected>-</option>
            </select>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" name="phone_number">
        </div>
        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota">
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" name="provinsi">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address"></textarea>
        </div>
        <div class="form-group">
            <label for="NIK">NIK</label>
            <input type="text" class="form-control" name="NIK">
        </div>
        <div class="form-group">
            <label for="NPWP">NPWP</label>
            <input type="text" class="form-control" name="NPWP">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="open" selected>Open</option>
                <option value="contacted">Contacted</option>
                <option value="qualified">Qualified</option>
                <option value="unqualified">Unqualified</option>
            </select>
        </div>
        <div class="form-group">
            <label for="source">Source</label>
            <select name="source" class="form-control">
                <option value="Advertisement">Advertisement</option>
                <option value="Web" selected>Web</option>
                <option value="Word of Mouth">Word of Mouth</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Lead</button>
    </form>
</div>
@endsection
