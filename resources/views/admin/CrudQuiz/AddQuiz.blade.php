@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Add Quiz</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0" href="{{ route('ManageQuiz') }}"><i
                                        class="fas fa-sign-out"></i>&nbsp;&nbsp;Back</a>
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
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Quiz Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('AddedQuiz') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">PIC Point</label>
                                            <input class="form-control " type="text" placeholder="Muhamad Sirojudin"
                                                name="QuizTitle" readonly>
                                            @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Point</label>
                                            <input class="form-control " type="text" placeholder="Bandung DC"
                                                name="QuizTitle" readonly>
                                            @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Activity Type</label>
                                            <input class="form-control " type="text" placeholder=" Activity Point"
                                                name="QuizTitle" readonly>
                                            @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Customer Name</label>
                                            <input class="form-control " type="text" placeholder="Indra dwi gunawan"
                                                name="QuizTitle" readonly>
                                            @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for="id_start_datetime">Location Activity</label>
                                        <div class="" >
                                            <p class="text-xs font-weight-bold mb-0 display: flex;" id="demo" ></p>
                                            <button type="button" class="btn btn-success" data-mdb-ripple-init onclick="getLocation()">Update Location</button>
                                        </div>
                                      </div>
                                    <div class="form-group">
                                        <label class="label-control" for="id_start_datetime">Date Activity</label>
                                        <div class="" >
                                          <input type="datetime-local" value="" class="form-control" placeholder="Enter Enroll Date" name="EnrollDate" required/>
                                        </div>
                                      </div>

                                      <div class="form-group table-responsive p-0 ">
                                        <label class="label-control" for="id_start_datetime">QC Form</label>
                                        <div class="" >
                                            <table class="table align-items-center ">
                                                <tbody>
                                                  <tr>
                                                    <td class="w-30">
                                                      <div class="d-flex px-2 py-1 align-items-center">
                                                     
                                                        <div class="ms-4">
                                                          <p class="text-xs font-weight-bold mb-0">Spare Part:</p>
                                                          <h6 class="text-sm mb-0">Sub Assy Dosing</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center "> 
                                                        <p class="text-xs font-weight-bold mb-0">Good:</p>
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">Not Good</p>
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td class="align-middle text-sm">
                                                      <div class="col text-center">
                                                        <p class="text-xs font-weight-bold mb-0">Reason:</p>
                                                        <h6 class="text-sm mb-0">Add</h6>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="w-30">
                                                      <div class="d-flex px-2 py-1 align-items-center">
                                                     
                                                        <div class="ms-4">
                                                          <h6 class="text-sm mb-0">Sub Assy Thrower</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center">
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center">
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td class="align-middle text-sm">
                                                        <div class="col text-center">
                                                          <h6 class="text-sm mb-0">Add</h6>
                                                        </div>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="w-30">
                                                      <div class="d-flex px-2 py-1 align-items-center">
                                                     
                                                        <div class="ms-4">
                                                          <h6 class="text-sm mb-0">Container</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center "> 
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center">
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td class="align-middle text-sm">
                                                      <div class="col text-center">
                                                        <h6 class="text-sm mb-0">Add</h6>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td class="w-30">
                                                      <div class="d-flex px-2 py-1 align-items-center">
                                                     
                                                        <div class="ms-4">
                                                          <h6 class="text-sm mb-0">Skirt</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center">
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td>
                                                      <div class="text-center">
                                                        <input class="" type="checkbox" value="" id="flexCheckIndeterminate">
                                                      </div>
                                                    </td>
                                                    <td class="align-middle text-sm">
                                                        <div class="col text-center">
                                                          <h6 class="text-sm mb-0">Add</h6>
                                                        </div>
                                                      </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                        </div>
                                      </div>
                                      <div class="col-md-">
                                        <label for="example-text-input" class="form-control-label">Actual Quantity</label>
                                        <input type="number" id="form6Example6" class="form-control" />
                                      </div>
                                      <div class="col-md-">
                                        <label for="example-text-input" class="form-control-label">Foto Hasil Point </label>
                                        <input class="form-control" type="file" id="formFileMultiple" multiple />
                                      </div>
                                    <div class="col-md-">

                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Resume Activities </label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Your Quiz Description" rows="3"
                                                name="QuizDesc"></textarea>
                                                @error('QuizDesc')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                   
                                   
                                </div>
                            </div>

                            <div class="col-1 text-end">
                                <button class="btn bg-gradient-success mb-2" type="submit"></i>&nbsp;&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const x = document.getElementById("demo");
        
        function getLocation() {
          console.log("Getting location...");
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
          } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
        
        function showPosition(position) {
          console.log("Position retrieved:", position);
          x.innerHTML = "Latitude: " + position.coords.latitude +
          "<br>Longitude: " + position.coords.longitude;
        }
    
        function showError(error) {
          console.log("Geolocation error:", error);
          switch(error.code) {
            case error.PERMISSION_DENIED:
              x.innerHTML = "User denied the request for Geolocation."
              break;
            case error.POSITION_UNAVAILABLE:
              x.innerHTML = "Location information is unavailable."
              break;
            case error.TIMEOUT:
              x.innerHTML = "The request to get user location timed out."
              break;
            case error.UNKNOWN_ERROR:
              x.innerHTML = "An unknown error occurred."
              break;
          }
        }
    </script>
    
@endsection

