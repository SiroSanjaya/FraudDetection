@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Data Order</h4>
                            </div>
                            
                        </div>

                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">

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
                    <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item" onclick="showTable('Workshop')">
                  <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true" >
                 200
                    <span class="ms-2">Draft</span>
                  </a>
                </li>
                <li class="nav-item" onclick="showTable('Workshop')">
                    <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true" >
                   200
                      <span class="ms-2">Create</span>
                    </a>
                  </li>
                <li class="nav-item" onclick="showTable('tableB')">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    100
                    <span class="ms-2">In Progress</span>
                  </a>
                </li>
                <li class="nav-item" onclick="showTable('Attendence')">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    50
                    <span class="ms-2">Done</span>
                  </a>
                </li>
              </ul>
     
  <div class="container">
    <div class="row mt-4">
      <div class="col">
    
       
      </div>
    </div>


    <div class="table-responsive p-0">

      </div>
    </div>
            </div>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Point</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                   Custome Name</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                   Feeder Type</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                   Request Quantity
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-3">
                                        <h6 class="mb-0 text-sm">ASD-7305-FDR-04-24-KHZM</h6>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-2">DC Bandung (Lawe)</p>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">CHRISTOPHER SUSANTO</span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">Shrimp</span>
                                        <div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">4</span>
                                        <div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                <a href="{{ route('DetailUser') }}"> 
                                    <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                    data-bs-placement="left" title="Detail"> 
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                    </a>
                                    <a href="{{ route('EditAttendence') }}"> 
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
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">1345</span>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold text-danger">Expired</span>
                                        <div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('DetailUser') }}"> 
                                        <button class="btn btn-white border-radius-lg mb-0 me-2" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Detail"> 
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                        </a>
                                        <a href="{{ route('EditAttendence') }}"> 
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
                                <td class="align-middle text-center ">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">6132</span>
                                        <div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">valid</span>
                                        <div>
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
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">2164</span>

                </div>
                </td>
                <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold text-danger">Expired</span>
                        <div>
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
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold">9219</span>
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold">valid</span>
                            <div>
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

            </div>
        </div>
        
        

@endsection
