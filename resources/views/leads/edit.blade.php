@extends('admin.layout.layout')
@section('title', 'Edit Lead')

@section('content')
<div class="container">
    <h1>Edit Lead</h1>
    <form action="{{ route('leads.update', $lead->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
            <input type="text" class="form-control" name="phone_number" value="{{ $lead->phone_number }}" required>
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
            <label for="fishery_address">Fishery Address:</label>
            <input type="text" class="form-control" name="fishery_address" value="{{ $lead->fishery_address }}">
        </div>

        <div class="form-group">
            <label for="fishery_lat">Fishery Latitude:</label>
            <input type="text" class="form-control" name="fishery_lat" value="{{ $lead->fishery_lat }}">
        </div>

        <div class="form-group">
            <label for="fishery_lng">Fishery Longitude:</label>
            <input type="text" class="form-control" name="fishery_lng" value="{{ $lead->fishery_lng }}">
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
            <label for="ktp_image">Upload KTP Image:</label>
            <input type="file" class="form-control" id="ktp_image" name="ktp_image" accept="image/*">
            @if ($lead->ktp_image)
                <div class="mt-2">
                    <img src="{{ asset($lead->ktp_image) }}" alt="KTP Image" class="img-fluid" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="survey_description">Survey Description:</label>
            <textarea class="form-control" name="survey_description" required>{{ $lead->survey ? $lead->survey->description : '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="survey_images">Survey Images:</label>
            <input type="file" class="form-control" id="survey_images" name="survey_images[]" accept="image/*" multiple>
            @if ($lead->survey && $lead->survey->images->isNotEmpty())
                <div class="mt-2">
                    @foreach ($lead->survey->images as $image)
                        <img src="{{ asset($image->image_path) }}" alt="Survey Image" class="img-fluid" style="max-width: 200px;">
                    @endforeach
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Lead</button>
    </form>
</div>
@endsection
