@extends('admin.layout.layout')
@section('content')
<style>

/* Style untuk overlay */
.overlay, .scanner-popup {
    display: none; /* Pastikan ini diatur seperti ini secara default */
    position: fixed; /* Contoh untuk memastikan elemen scanner muncul di atas */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 999; /* Pastikan z-index cukup tinggi */
    background-color: rgba(0, 0, 0, 0.5); /* Overlay */
}

.scanner-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center the scanner */
    width: 300px;
    background-color: white;
    z-index: 1000;


}
.reason-link {
    color: #007bff;
    cursor: pointer;
    text-decoration: underline;
  }

  .reason-link:hover {
    color: #0056b3;
  }

  .hidden {
    display: none;
  }

</style>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Form Activity</h4>
                            </div>
                            <div class="col-6 text-end">
                                {{-- <a class="btn bg-gradient-success mb-0" href="{{ route('PointDetail') }}"><i
                                        class="fas fa-sign-out"></i>&nbsp;&nbsp;Back</a> --}}
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
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">PIC Point</label>
                                            <input class="form-control " type="text" placeholder="Muhamad Sirojudin"
                                                name="QuizTitle" readonly>
                                            {{-- @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Point</label>
                                            <input class="form-control " type="text" placeholder="Bandung DC"
                                                name="QuizTitle" readonly>
                                            {{-- @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Activity Type</label>
                                            <input class="form-control " type="text" placeholder=" Activity Point"
                                                name="QuizTitle" readonly>
                                            {{-- @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Customer Name</label>
                                            <input class="form-control " type="text" placeholder="Indra dwi gunawan"
                                                name="QuizTitle" readonly>
                                            {{-- @error('QuizTitle')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror --}}
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
                                      <div class="form-outline" data-mdb-input-init>
                                        <label class="form-label" for="typeNumber">Actual Quantity</label>
                                        <input type="number" id="typeNumber" class="form-control" min="1" />
                                      </div>
                                      <!-- Container untuk menampung elemen Feeder dan Cobox yang dinamis -->
                                      <div id="dynamicContainers"></div>
                                      <div id="scanResults" class="mt-3"></div>
                                      {{-- <div class="form-group">
                                        <label class="label-control" for="feeder_details">Detail Feeder</label>
                                        <div>
                                            <div id="overlay_feeder" class="overlay"></div>
                                            <p class="text-xs font-weight-bold mb-0" id="barcode_feeder"></p>
                                            <button type="button" class="btn btn-success" onclick="scanFeeder()">SCAN FEEDER</button>
                                            <div id="reader_feeder" class="scanner-popup"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-control" for="cobox_details">Detail Cobox</label>
                                        <div>
                                            <div id="overlay_cobox" class="overlay"></div>
                                            <p class="text-xs font-weight-bold mb-0" id="barcode_cobox"></p>
                                            <button type="button" class="btn btn-success" onclick="scanCobox()">SCAN COBOX</button>
                                            <div id="reader_cobox" class="scanner-popup"></div>
                                        </div>
                                    </div> --}}

                                      <div class="form-group table-responsive p-0 ">
                                        {{-- <label class="label-control" for="id_start_datetime">QC Form</label>
                                        <div class="" >
                                            <table class="table align-items-center ">
                                                <tbody>
                                                    <td class="w-30">
                                                        <div class="d-flex px-2 py-1 align-items-center">
                                                            <div class="ms-4">
                                                                <p class="text-xs font-weight-bold mb-0">Spare Part:</p>
                                                                <h6 class="text-sm mb-0">Sub Assy Dosing</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">Good:</p>
                                                            <input type="radio" name="inlineRadioOptions1" value="good" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">Not Good:</p>
                                                            <input type="radio" name="inlineRadioOptions1" value="not_good" />
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-sm">
                                                        <div class="col text-center">
                                                            <p class="text-xs font-weight-bold mb-0">Reason:</p>
                                                            <h6 class="text-sm mb-0"><a href="#" class="reason-link" onclick="addReason(this)">Add</a></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <td class="w-30">
                                                    <div class="d-flex px-2 py-1 align-items-center">
                                                        <div class="ms-4">
                                                            <h6 class="text-sm mb-0">Sub Assy Thrower</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <input type="radio" name="inlineRadioOptions2" value="good" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <input type="radio" name="inlineRadioOptions2" value="not_good" />
                                                    </div>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <div class="col text-center">
                                                        <h6 class="text-sm mb-0"><a href="#" class="reason-link" onclick="addReason(this)">Add</a></h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">Sub Assy Control Box</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <input type="radio" name="inlineRadioOptions3" value="good" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <input type="radio" name="inlineRadioOptions3" value="not_good" />
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="col text-center">
                                                    <h6 class="text-sm mb-0"><a href="#" class="reason-link" onclick="addReason(this)">Add</a></h6>
                                                </div>
                                            </td>
                                        </tr>
                                                </tbody>
                                              </table> --}}
                                              <!-- Modal untuk Input Reason -->
                                              <div class="modal fade" id="inputReasonModal" tabindex="-1" aria-labelledby="inputReasonModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="inputReasonModalLabel">Enter Reason</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" id="reasonInput" placeholder="Type the defect reason here...">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" onclick="saveReason()">Save Reason</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal untuk Menampilkan Reason -->
                                            <div class="modal fade" id="showReasonModal" tabindex="-1" aria-labelledby="showReasonModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showReasonModalLabel">Reason Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="reasonText">
          <!-- Reason akan ditampilkan di sini -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

                                        </div>
                                      </div>
                                      <div class="col-md-">
                                        <label for="example-text-input" class="form-control-label">Foto Hasil Point </label>
                                        <input class="form-control" type="file" id="formFileMultiple" multiple />
                                      </div>

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
                                    <div class="col-1 text-end">
                                        <button class="btn bg-gradient-success mb-2" type="submit"  onclick="showAcceptedConfirmation(this)"></i>&nbsp;&nbsp;Submit</button>
                                    </div>
                                </div>
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
            x.innerHTML = "<div class='geo-data'><span>Latitude: " + position.coords.latitude + "</span>" +
                "<span style='display: inline-block; margin-bottom: 20px; margin-left: 20px'>Longitude: " + position.coords.longitude + "</span></div>";
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

<script>
document.getElementById('typeNumber').addEventListener('input', function() {
    const quantity = parseInt(this.value, 10) || 0;
    const container = document.getElementById('dynamicContainers');

    container.innerHTML = '';  // Bersihkan container sebelumnya

    // Loop untuk membuat dan menambahkan elemen baru
    for (let i = 0; i < quantity; i++) {
        container.appendChild(createFeederCoboxGroup(i, 'Feeder'));
        container.appendChild(createFeederCoboxGroup(i, 'Cobox'));
    }
});

function createFeederCoboxGroup(index, type) {
    const div = document.createElement('div');
    div.className = 'form-group';

    const label = document.createElement('label');
    label.className = 'label-control';
    label.textContent = `Detail ${type} ${index + 1}`;

    const innerDiv = document.createElement('div');

    const overlay = document.createElement('div');
    overlay.className = 'overlay';
    overlay.id = `overlay_${type.toLowerCase()}${index}`;

    const p = document.createElement('p');
    p.className = 'text-xs font-weight-bold mb-0';
    p.id = `barcode_${type.toLowerCase()}${index}`;

    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-success';
    button.textContent = `SCAN ${type.toUpperCase()}`;
    button.setAttribute('onclick', `scan${type}(${index})`);

    const readerDiv = document.createElement('div');
    readerDiv.className = 'scanner-popup';
    readerDiv.id = `reader_${type.toLowerCase()}${index}`;

    innerDiv.appendChild(overlay);
    innerDiv.appendChild(p);
    innerDiv.appendChild(button);
    innerDiv.appendChild(readerDiv);

    div.appendChild(label);
    div.appendChild(innerDiv);

    return div;
}

function scanFeeder(index) {
    const result = `Feeder ${index + 1} scanned successfully!`;
    displayResult(result);
}

function scanCobox(index) {
    const result = `Cobox ${index + 1} scanned successfully!`;
    displayResult(result);
}

function displayResult(message) {
    const resultsDiv = document.getElementById('scanResults');
    const result = document.createElement('p');
    result.textContent = message;
    resultsDiv.appendChild(result);
}


</script>

<script>
    document.getElementById('typeNumber').addEventListener('input', function(event) {
    const quantity = parseInt(this.value, 10) || 0;
    const container = document.getElementById('dynamicContainers');
    container.innerHTML = ''; // Clear existing contents

    for (let i = 0; i < quantity; i++) {
        container.appendChild(createScannerGroup(i, 'Feeder'));
        container.appendChild(createScannerGroup(i, 'Cobox'));
    }
    event.preventDefault(); // Menambahkan ini untuk menghindari submission tidak diinginkan
});

function createScannerGroup(index, type) {
    const div = document.createElement('div');
    div.className = 'form-group';

    const label = document.createElement('label');
    label.className = 'label-control';
    label.textContent = `Detail ${type} ${index + 1}`;

    const resultP = document.createElement('p');
    resultP.className = 'text-xs font-weight-bold mb-0';
    resultP.id = `barcode_${type.toLowerCase()}${index}`;

    const button = document.createElement('button');
    button.type = 'button'; // Pastikan ini adalah tipe button, bukan submit
    button.className = 'btn btn-success';
    button.textContent = `SCAN ${type.toUpperCase()}`;
    button.addEventListener('click', function(event) {
        startScanner(`reader_${type.toLowerCase()}${index}`, `overlay_${type.toLowerCase()}${index}`, `barcode_${type.toLowerCase()}${index}`);
        event.preventDefault(); // Menghindari reload halaman
    });

    const overlay = document.createElement('div');
    overlay.className = 'overlay';
    overlay.id = `overlay_${type.toLowerCase()}${index}`;
    overlay.style.display = 'none';

    const readerDiv = document.createElement('div');
    readerDiv.className = 'scanner-popup';
    readerDiv.id = `reader_${type.toLowerCase()}${index}`;
    readerDiv.style.display = 'none';

    div.appendChild(label);
    div.appendChild(resultP);
    div.appendChild(button);
    div.appendChild(overlay);
    div.appendChild(readerDiv);

    return div;
}


    </script>




@endsection

