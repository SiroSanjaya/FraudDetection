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
                    <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item" onclick="showTable('Workshop')">
                  <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true" >
                    <i class="ni ni-books" ></i>
                    <span class="ms-2">Workshop</span>
                  </a>
                </li>
                <li class="nav-item" onclick="showTable('tableB')">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-email-83"></i>
                    <span class="ms-2">Quiz</span>
                  </a>
                </li>
                <li class="nav-item" onclick="showTable('Attendence')">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-settings-gear-65"></i>
                    <span class="ms-2">Attendence</span>
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
                        <div class="table-container" id="Workshop"> 
                        <table class="table align-items-center justify-content-center mb-0"  >
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bisnis Unit</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Workshop</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Date</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Completion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">SS01Q2</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Adi Prasetyo</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Fish</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Access Point Installation</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">03 October 2023</p>
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
                                    <td class="align-middle">
                                    <a href="{{ route('DetailUser') }}"> 
                                        <button class="btn btn-link text-secondary mb-0" > 
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                            </div>

                            <div id="tableB" class="table-container"> 
                        <table class="table align-items-center justify-content-center mb-0"  >
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bisnis Unit</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Quiz</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Score</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Completion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">312</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Adi Prasetyo</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Fish</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Product Knowledge Water Quality </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">85 </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">70%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success " role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                    <a href="{{ route('DetailUser') }}"> 
                                        <button class="btn btn-link text-secondary mb-0" > 
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                            <div id="Attendence" class="table-container"> 
                        <table class="table align-items-center justify-content-center mb-0"  >
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bisnis Unit</th>

                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Completion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <h6 class="mb-0 text-sm">210</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-2">Adi Prasetyo</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">Fish</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">70%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success " role="progressbar"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                    <a href="{{ route('DetailUser') }}"> 
                                        <button class="btn btn-link text-secondary mb-0" > 
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                            </div>
                           
                            </div>
            </div>
        </div>
    </div>

<script>
  // Fungsi untuk menampilkan tabel berdasarkan ID
  function showTable(tableId) {
    // Sembunyikan semua tabel
    var tables = document.getElementsByClassName('table-container');
    for (var i = 0; i < tables.length; i++) {
      tables[i].style.display = 'none';
    }

    // Tampilkan tabel yang sesuai
    var tableToShow = document.getElementById(tableId);
    if (tableToShow) {
      tableToShow.style.display = 'block';
    }
  }

  // Tampilkan tabel A secara otomatis
  showTable('Workshop');
</script>

@endsection
