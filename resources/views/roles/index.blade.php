@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Roles and Permissions</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td class="d-flex flex-wrap" style="">
                        @foreach ($role->permissions as $permission)
                            <span class="badge bg-secondary"style="margin:5px">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('roles.edit_permissions', $role->id) }}" class="btn btn-primary">Edit Permissions</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
