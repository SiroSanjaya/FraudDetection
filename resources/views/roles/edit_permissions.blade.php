@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Edit Permissions for {{ $role->name }}</h1>
    <form action="{{ route('roles.update_permissions', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        @foreach ($allPermissions as $permission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                       id="permission_{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission_{{ $permission->id }}">
                    {{ $permission->name }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-2">Update Permissions</button>
    </form>
</div>
@endsection
