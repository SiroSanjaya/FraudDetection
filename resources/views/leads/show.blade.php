@extends('admin.layout.layout')
@section('title', 'Lead Details')

@section('content')
@php
    $score = $lead->score;
    $colorClass = 'bg-secondary'; // Default value
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
<div class="container">
    <h1>Lead Details</h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $lead->first_name }} {{ $lead->last_name }}</h4>
            <p class="fs-5 fw-bold text-left">Lead Score: {{ $score }}</p> 
                <div class="progress mb-3" style="height: 60px; width: 20%;">                                   
                    <div class="progress-bar {{ $colorClass }}" role="progressbar" style="width: {{ $score }}%" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="card-text">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Email</th>
                                <td>{{ $lead->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $lead->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td>{{ $lead->kota }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>{{ $lead->provinsi }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $lead->address }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $lead->NIK }}</td>
                            </tr>
                            <tr>
                                <th>NPWP</th>
                                <td>{{ $lead->NPWP }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $lead->status }}</td>
                            </tr>
                            <tr>
                                <th>Source</th>
                                <td>{{ $lead->source }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $lead->created_at->toFormattedDateString() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if($lead->survey && $lead->survey->images->isNotEmpty())
            <div id="carouselSurveyImages" class="carousel slide" data-bs-ride="carousel" style="background-color: #f8f9fa; padding: 20px;">
            <div class="carousel-inner">
                @foreach($lead->survey->images as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset($image->image_path) }}" class="d-block w-100" alt="Survey Image">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSurveyImages" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSurveyImages" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
            @endif
            <br>

        <a href="{{ route('leads.index') }}" class="btn btn-primary">Back to List</a>
        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-secondary">Edit Lead</a>
        </div>
    </div>    
</div>

@endsection
