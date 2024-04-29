@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Users</h1>

    <!-- Filter Form -->
    <div class="mb-3">
        <form action="{{ route('users.index') }}" method="GET" class="form-inline">
            <label for="role" class="mr-sm-2">Filter by Role:</label>
            <select name="role" id="role" class="form-control mb-2 mr-sm-2" onchange="this.form.submit()">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $filterRole == $role->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- User Count -->
    <p>{{ $count }} results found.</p>

    <!-- User Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
