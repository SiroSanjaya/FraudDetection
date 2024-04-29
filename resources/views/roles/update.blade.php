@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Permissions Update Successful</h1>
    <p>Permissions have been successfully updated for the role.</p>
    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles</a>
</div>
@endsection
