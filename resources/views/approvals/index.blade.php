@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Lead Approvals</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->first_name }} {{ $lead->last_name }}</td>
                    <td>{{ $lead->status }}</td>
                    <td><span>{{ $lead->score }} </span></td>
                    <td>
                        <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-primary">View</a>
                        <!-- Add other actions as necessary -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
