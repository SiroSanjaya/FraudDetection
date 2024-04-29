@extends('admin.layout.layout')
@section('title', 'Edit Lead')

@section('content')
<div class="container">
    <h1>Edit Lead</h1>
    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="salutation">Salutation:</label>
            <select class="form-control" name="salutation" required>
                <option value="Bapak" {{ $lead->salutation == 'Bapak' ? 'selected' : '' }}>Bapak</option>
                <option value="Ibu" {{ $lead->salutation == 'Ibu' ? 'selected' : '' }}>Ibu</option>
            </select>
        </div>

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="{{ $lead->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="{{ $lead->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $lead->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" name="phone_number" value="{{ $lead->phone_number }}">
        </div>

        <div class="form-group">
            <label for="kota">Kota:</label>
            <input type="text" class="form-control" name="kota" value="{{ $lead->kota }}">
        </div>

        <div class="form-group">
            <label for="provinsi">Provinsi:</label>
            <input type="text" class="form-control" name="provinsi" value="{{ $lead->provinsi }}">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" name="address">{{ $lead->address }}</textarea>
        </div>

        <div class="form-group">
            <label for="NIK">NIK:</label>
            <input type="text" class="form-control" name="NIK" value="{{ $lead->NIK }}">
        </div>

        <div class="form-group">
            <label for="NPWP">NPWP:</label>
            <input type="text" class="form-control" name="NPWP" value="{{ $lead->NPWP }}">
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" name="status" required>
                <option value="open" {{ $lead->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="qualified" {{ $lead->status == 'qualified' ? 'selected' : '' }}>Qualified</option>
                <option value="unqualified" {{ $lead->status == 'unqualified' ? 'selected' : '' }}>Unqualified</option>
            </select>
        </div>

        <div class="form-group">
            <label for="source">Source:</label>
            <select class="form-control" name="source" required>
                <option value="Advertisement" {{ $lead->source == 'Advertisement' ? 'selected' : '' }}>Advertisement</option>
                <option value="Web" {{ $lead->source == 'Web' ? 'selected' : '' }}>Web</option>
                <option value="Word of Mouth" {{ $lead->source == 'Word of Mouth' ? 'selected' : '' }}>Word of Mouth</option>
                <option value="Other" {{ $lead->source == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Lead</button>
    </form>
</div>
@endsection
