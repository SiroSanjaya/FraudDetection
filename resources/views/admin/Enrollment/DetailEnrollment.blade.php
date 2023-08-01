@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">
                                    <a href="{{ route('ManageEnrollment') }}">Manage Enrollment > </a>
                                    {{ $enrollment->Enrollment_Title }}
                                </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0"
                                    href="{{ route('AddDetailEnrollment', ['category' => $enrollment->Enrollment_Title]) }}"><i
                                        class="fas fa-plus"></i>&nbsp;&nbsp;Add User</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">List User Enroll</h6>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            No
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Username</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Bisnis Unit</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Enroll Date</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Completion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($enroll as $e)
                                        <tr>
                                            <td class="text-center">
                                                <h6 class="mb-0 text-sm">{{ $no++ }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-sm font-weight-bold mb-2">{{ $e->username }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-xs font-weight-bold">{{ $e->Bisnis_Unit_Name }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-xs font-weight-bold">{{ $e->Enroll_Date }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-group d-flex justify-content-center align-items-center">
                                                    <span class="text-xs font-weight-bold me-3">100%</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success " role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('EditDetailEnrollment', ['category' => $enrollment->Enrollment_Title,'id' => $e->Enroll_Id]) }}"
                                                    class="btn btn-white border-radius-lg p-2 mt-0  mx-md-0" type="button"
                                                    data-bs-toggle="tooltip" data-bs-placement="left" title="Edit">
                                                    <i class="fas fa-pencil p-2"></i>
                                                </a>
                                                <button class="btn btn-white text-danger border-radius-lg p-2 mt-0 mx-md-0"
                                                    type="button" data-bs-toggle="tooltip"
                                                    onclick="showDeleteConfirmation(this)" data-bs-placement="left"
                                                    title="Delete" id="delete"
                                                    data-href='{{ route('DeleteDetailEnrollment', ['category' => $enrollment->Enrollment_Title,'id' => $e->Enroll_Id]) }}'>
                                                    <i class="fas fa-trash p-2"></i>
                                                </button>

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

        @if ($message = session('success'))
            <script>
                Swal.fire({
                    position: 'top-mid',
                    icon: 'success',
                    title: '{{ $message }}',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        @endif
    @endsection
