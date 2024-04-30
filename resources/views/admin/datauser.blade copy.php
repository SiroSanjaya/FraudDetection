@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Data User</h4>
                            </div>
                            <div class="col-6 text-end">
                        
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
        <div class="row mt-4">
        <div class="">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                    <div class="col-6 ">
                            </div>
                            <div class="col-3 text-end">
                            <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
          </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Leads ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Leads Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Phone</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            City</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Created At</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Created By</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $c)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">{{ $c->user_id}}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">{{ $c->username }}</p>
                                    </td>
                                    <td>
                                        {{-- <span class="text-xs font-weight-bold">{{$BisnisUnit->where('Bisnis_Unit_Id', $c->Bisnis_Unit_Id)->first()->Bisnis_Unit_Name}}</span> --}}
                                    </td>
                                    <td>
                                        {{-- <span class="text-xs font-weight-bold">{{$Region->where('id_region', $c->id_region)->first()->region_name}}</span> --}}
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold text-center">{{ $c->role }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">100%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success " role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('DetailUser') }}"> 
                                            <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Detail"> 
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                            </a>
                                            <a href="{{ route('EditUser', ['id' => $c->user_id]) }}"> 
                                                <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Edit"> 
                                                    <i class="fa fa-pencil text-xs"></i>
                                                </button>
                                                </a>
                                                <a href="{{ route('DeletedUser', ['id' => $c->user_id]) }}"> 
                                                    <button class="btn btn-white border-radius-lg mb-0 text-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Delete"  onclick="showDeleteConfirmation(this)"> 
                                                        <i class="fa fa-trash text-xs" ></i>
                                                    </button>
                                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @endforeach
                                        
                    </tr>
                    <tr>
                    </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  
@endsection
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