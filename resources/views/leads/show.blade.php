@extends('admin.layout.layout')
@section('title', 'Lead Details')

@section('content')
<div class="container">
    <h1>Lead Details</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $lead->first_name }} {{ $lead->last_name }}</h4>
            <p class="card-text">
                <strong>Email:</strong> {{ $lead->email }}<br>
                <strong>Phone Number:</strong> {{ $lead->phone_number }}<br>
                <strong>Kota:</strong> {{ $lead->kota }}<br>
                <strong>Provinsi:</strong> {{ $lead->provinsi }}<br>
                <strong>Address:</strong> {{ $lead->address }}<br>
                <strong>NIK:</strong> {{ $lead->NIK }}<br>
                <strong>NPWP:</strong> {{ $lead->NPWP }}<br>
                <strong>Status:</strong> {{ $lead->status }}<br>
                <strong>Source:</strong> {{ $lead->source }}<br>
                <strong>Created At:</strong> {{ $lead->created_at->toFormattedDateString() }}<br>

                @php
                    $score = $lead->score;
                    $colorClass = '';

                    if ($score < 20) {
                        $colorClass = 'bg-danger';
                    } elseif ($score < 40) {
                        $colorClass = 'bg-warning';
                    } elseif ($score < 60) {
                        $colorClass = 'bg-primary';
                    } elseif ($score < 80) {
                        $colorClass = 'bg-info';
                    } else {
                        $colorClass = 'bg-success';
                    }
                @endphp
                <!-- Display the lead's score -->    
                <p class="fs-5 fw-bold text-left ">Lead Score: {{ $leadScore }}</p> 
                <div class="progress mb-3 " style="height: 60px; width:20%;" >                                   
                    <div class="progress-bar {{ $colorClass }}" role="progressbar" style="width: {{ $score }}%" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100" >   
                    </div>
                </div>
            </p>
            <a href="{{ route('leads.index') }}" class="btn btn-primary">Back to List</a>
            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-secondary">Edit Lead</a>
        </div>
    </div>
</div>
@endsection
