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
                                <a class="btn bg-gradient-success mb-0" href="{{ route('AddUser') }}"><i
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bisnis Unit</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Region</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Role</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Completion</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">1</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Adi Prasetyo</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Fish</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Kalimantan</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold text-center">FTS</span>
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
                                            <a href="{{ route('EditUser') }}"> 
                                                <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Edit"> 
                                                    <i class="fa fa-pencil text-xs"></i>
                                                </button>
                                                </a>
                                                <a href="{{ route('DetailUser') }}"> 
                                                    <button class="btn btn-white border-radius-lg mb-0 text-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Delete" > 
                                                        <i class="fa fa-trash text-xs" ></i>
                                                    </button>
                                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">2</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Dadang Hermawan</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Fish</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">National</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Teacher</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">80%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 80%;"></div>
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
                                            <a href="{{ route('DetailUser') }}"> 
                                                <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Edit"> 
                                                    <i class="fa fa-pencil text-xs"></i>
                                                </button>
                                                </a>
                                                <a href="{{ route('DetailUser') }}"> 
                                                    <button class="btn btn-white border-radius-lg mb-0 text-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Delete" > 
                                                        <i class="fa fa-trash text-xs" ></i>
                                                    </button>
                                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">3</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Dinul Fikri</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Shrimp</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">National</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Admin</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">60%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="60"
                                                        style="width: 60%;"></div>
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
                                            <a href="{{ route('DetailUser') }}"> 
                                                <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Edit"> 
                                                    <i class="fa fa-pencil text-xs"></i>
                                                </button>
                                                </a>
                                                <a href="{{ route('DetailUser') }}"> 
                                                    <button class="btn btn-white border-radius-lg mb-0 text-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Delete" > 
                                                        <i class="fa fa-trash text-xs" ></i>
                                                    </button>
                                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">4</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Maulana Rifki</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Fish</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">National</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Employee</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">30%</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"
                                                    style="width: 30%;"></div>
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
                            <a href="{{ route('DetailUser') }}"> 
                                <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                data-bs-placement="left" title="Edit"> 
                                    <i class="fa fa-pencil text-xs"></i>
                                </button>
                                </a>
                                <a href="{{ route('DetailUser') }}"> 
                                    <button class="btn btn-white border-radius-lg mb-0 text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="left" title="Delete" > 
                                        <i class="fa fa-trash text-xs" ></i>
                                    </button>
                                    </a>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex px-3">
                                <h6 class="mb-0 text-sm">5</h6>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">Muhamad Sirojudin</p>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Fish</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">National</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Admin</span>
                        </td>
                        <td class="align-middle text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="me-2 text-xs font-weight-bold">0%</span>
                                <div>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"
                                                style="width: 0%;"></div>
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
                                <a href="{{ route('DetailUser') }}"> 
                                    <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="left" title="Edit"> 
                                        <i class="fa fa-pencil text-xs"></i>
                                    </button>
                                    </a>
                                    <a href="{{ route('DetailUser') }}"> 
                                        <button class="btn btn-white border-radius-lg mb-0 text-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Delete" > 
                                            <i class="fa fa-trash text-xs" ></i>
                                        </button>
                                        </a>
                        </td>
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
