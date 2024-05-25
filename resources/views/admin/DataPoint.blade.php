@extends('admin.layout.layout')

@section('content')

<style>

.text-success {
    color: green;
}

.text-danger {
    color: red;
}

</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-capitalize">Data Point</h4>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('AddPoint') }}" class="btn btn-primary">Add Point</a>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Point ID</th>
                                    <th>Point Name</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($points as $point)
                                <tr>
                                    <td>{{ $point->point_id }}</td>
                                    <td>{{ $point->point_name }}</td>
                                    <td>{{ $point->location }}</td>
                                    <td>
                                    <a href="{{ route('EditPoint', ['id' => $point->point_id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="deletePoint('{{ route('delete', ['id' => $point->point_id]) }}')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        function deletePoint(url) {
            if (confirm('Apakah Anda yakin ingin menghapus titik ini?')) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        // Refresh halaman atau tangani sukses sesuai kebutuhan
                        window.location.reload();
                    } else {
                        // Tangani kesalahan
                        console.error('Gagal menghapus titik');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>

@endsection
