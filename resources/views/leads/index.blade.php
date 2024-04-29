@extends('admin.layout.layout')
@section('title', 'Lead Listing')

@section('content')
<div class="container">
    <h1>Submitted Leads</h1>
    
    <!-- Filter Form -->
    <form method="GET" action="{{ route('leads.index') }}">
        <div class="form-group row">
            <label for="status" class="col-form-label col-sm-2">Filter by Status:</label>
            <div class="col-sm-10">
                <select class="form-control" name="status" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $statusOption)
                        <option value="{{ $statusOption }}" {{ $selectedStatus == $statusOption ? 'selected' : '' }}>{{ $statusOption }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    
    <div class="table-responsive p-0">
    @if ($leads->isEmpty())
    <p>No records found for the selected status.</p>
    @else
        <!-- Display the list of leads -->
        <table class="table align-items-center justify-content-center mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Salutation</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Kota</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <tbody>
                @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->status }}</td>
                    <td>{{ $lead->salutation }}</td>
                    <td>{{ $lead->first_name }}</td>
                    <td>{{ $lead->last_name }}</td>
                    <td>{{ $lead->phone_number }}</td>
                    <td>{{ $lead->kota }}</td>
                    <td>
                    <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-eye" title="View Details"></i>
                    </a>
                        @role('admin')
                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" title="Delete"></i>
                            </button>   
                        </form>
                        @endrole
                    </td>                  
                </tr>
                @endforeach
            </tbody>
    @endif          
        </table>
    </div>  
</div>
@endsection
