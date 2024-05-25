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
<div class="container mt-4">
    <h1>Lead Details</h1>
    <a href="#" data-toggle="tooltip" title="Hooray!">Hover over me</a>

    <div>
        @if(auth()->user()->hasRole(['salesManager']))
            <!-- content for admin or salesManager -->
            <a href="{{ route('lead.approvals.index') }}" class="btn btn-primary px-4">Back to List</a>
        @else
            <!-- content for other roles -->
            <a href="{{ route('leads.index') }}" class="btn btn-primary px-4">Back to List</a>
            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-secondary px-4">Edit Lead</a>
        @endif
        @role('salesManager')
            @if($lead->status !== 'qualified' && $lead->status !== 'unqualified')
                <!-- Qualify Button -->
                <form action="{{ route('leads.approve', $lead->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success" type="submit">Qualify</button>
                </form>
                <!-- Disqualify Button -->
                <form action="{{ route('leads.disapprove', $lead->id) }}" method="POST" class="d-inline mt-2">
                    @csrf
                    <button class="btn btn-danger" type="submit">Disqualify</button>
                </form>
            @endif
        @endrole
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div>
                <p class="fs-5 fw-bold text-left">Lead Score: {{ $score }}</p>
                <div class="progress mb-3" style="height: 50px; width: 100%;">
                    <div class="progress-bar {{ $colorClass }}" role="progressbar" style="width: {{ $score }}%" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6">
                <h5 class="card-title">{{ $lead->first_name }} {{ $lead->last_name }}</h5>

                </div>
            </div>

            <div class="row">
                <div class="col">
                    @if($lead->ktp_image)
                        <div class="text-center mb-3">
                            <img src="{{ asset($lead->ktp_image) }}" alt="KTP Image" class="img-fluid" style="max-width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
                <div class="col-6">
                    <table class="table-responsive " style="padding:4px">
                        <tbody>
                            <tr>
                                <th>Email</th>
                                <td>{{ $lead->email }} 
                                    @if($lead->email_valid)
                                        <span class="badge bg-success" data-toggle="tooltip" data-bs-placement="top" title="Email is Validated by checking Bounce to the email via third party services.">Validated</span>
                                    @else
                                        <span class="badge bg-danger" data-toggle="tooltip" data-bs-placement="top" title="Email is Validated by checking Bounce to the email via third party services.">Not Validated</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $lead->phone_number }} 
                                    @if($lead->phone_valid)
                                        <span class="badge bg-success" data-toggle="tooltip" data-bs-placement="top" title="Phone Number is validated using third party services to check their availability to text messages or calls.">Validated</span>
                                    @else
                                        <span class="badge bg-danger" data-toggle="tooltip" data-bs-placement="top" title="Phone Number is validated using third party services to check their availability to text messages or calls.">Not Validated</span>
                                    @endif
                                </td>
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
                                <th>Status</th>
                                <td>{{ $lead->status }}</td>
                            </tr>
                            <tr>
                                <th>Source</th>
                                <td>{{ $lead->source }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-text mt-4">
                <h5>Fishery Location Details</h5>
            <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>

                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <th>Fishery Address</th>
                            <td>{{ $lead->fishery_address }}</td>
                        </tr>
                        <tr>
                            <th>Fishery Latitude</th>
                            <td>{{ $lead->fishery_lat }}</td>
                        </tr>
                        <tr>
                            <th>Fishery Longitude</th>
                            <td>{{ $lead->fishery_lng }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $lead->survey ? $lead->survey->description : 'No Description' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $lead->created_at->toFormattedDateString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if($lead->survey && $lead->survey->images->isNotEmpty())
                <div id="carouselSurveyImages" class="carousel slide mt-4 mx-auto" data-bs-ride="carousel" style="background-color: #f8f9fa; padding: 20px; max-width: 50%;">
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
        </div>
    </div>
</div>

<!-- Include Bootstrap CSS and JavaScript -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- GOOGLE MAPS SCRIPT -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places&v=weekly" async defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });

    let map, geocoder;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -6.3430817, lng: 106.7349329}, // Default location
            zoom: 20
        });
        geocoder = new google.maps.Geocoder();

        const lat = parseFloat('{{ $lead->fishery_lat }}');
        const lng = parseFloat('{{ $lead->fishery_lng }}');
        const address = '{{ $lead->fishery_address }}';

        if (!isNaN(lat) && !isNaN(lng)) {
            const location = {lat: lat, lng: lng};
            map.setCenter(location);
            new google.maps.Marker({
                map: map,
                position: location
            });
        } else if (address) {
            geocodeAddress(geocoder, map, address);
        }
    }

    function geocodeAddress(geocoder, resultsMap, address) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            });
</script>
@endsection
