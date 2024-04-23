
@extends('admin.layout.layout')
@section('title', 'Lead Listing')

@section('content')
<div class="container">
    <h1>Leads List</h1>
    <div class="table-responsive p-0">
    <table class="table align-items-center justify-content-center mb-0">
            <tr>
                <th class="text-uppercase font-weight-bolder opacity-7">ID</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Salutation</th>
                <th class="text-uppercase font-weight-bolder opacity-7">First Name</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Last Name</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Email</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Phone Number</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Kota</th>
                <!-- <th class="text-uppercase font-weight-bolder opacity-7">Provinsi</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Address</th>
                <th class="text-uppercase font-weight-bolder opacity-7">NIK</th>
                <th class="text-uppercase font-weight-bolder opacity-7">NPWP</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Source</th>
                <th class="text-uppercase font-weight-bolder opacity-7">Created At</th> -->
                <th class="text-uppercase font-weight-bolder opacity-7">Actions</th>
            </tr>
        <tbody>
            @foreach ($leads as $lead)
            <tr>
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->id }}</h6>
                </div>
            </td>
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->salutation }}</h6>
                </div>
            </td>
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->first_name }}</h6>
                </div>
            </td>    
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->last_name }}</h6>
                </div>
            </td> 
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->email }}</h6>
                </div>
            </td>
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->phone_number }}</h6>
                </div>
            </td> 
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->kota }}</h6>
                </div>
            </td>
            <!-- <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->provinsi }}</h6>
                </div>
            </td>   
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->address }}</h6>
                </div>
            </td> 
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->NIK }}</h6>
                </div>
            </td> 
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->NPWP }}</h6>
                </div>
            </td> 
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->status }}</h6>
                </div>
            </td> 
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->source }}</h6>
                </div>
            </td>
            <td>
                <div class="d-flex px-3">
                    <h6 class="  font-weight-light opacity-7">{{ $lead->created_at->toFormattedDateString() }}</h6>
                </div>
            </td> -->
                <td>
                    <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-info">Details</a>
                    <!-- <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary">Edit</a> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>  

    
</div>
@endsection
