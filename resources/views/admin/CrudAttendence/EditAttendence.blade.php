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
                                   Edit Attendence
                                </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0" href="{{ route('ManageEnrollment') }}"><i
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
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <img src="" alt="" id="PreviewImage">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label"> Bisnis 
                                                Unit</label>
                                            <input type="text" class="form-control"
                                                value="" readonly>

                                            {{-- Enrollment ID --}}
                                            <input type="text" class="form-control" name="EnrollmentID"
                                                value="" style="display: none">
                                            {{--  --}}

                                            @error('EnrollmentID')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Attendence Name</label>
                                            <input class="form-control " type="text" placeholder="Enter your Attendence Name"
                                                name="CategoryName" required>
                                            @error('CategoryName')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Attendence PIN</label>
                                            <input class="form-control " type="text" placeholder="Enter your Attendence PIN" id="inputPin" name="inputPin"
                                                name="CategoryName" readonly>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn bg-gradient-success md-4" type="submit" onclick="generateRandomPin()" id="pinOutput"></i>&nbsp;&nbsp;Generate Random PIN</button>
                                 
                                        <button class="btn bg-gradient-success " type="submit"  onclick="resetInput()"></i>&nbsp;&nbsp;Reset Input</button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-control" for="id_start_datetime">Start Date and Time:</label>
                                            <div class="" >
                                              <input type="datetime-local" value="" class="form-control" placeholder="Enter Enroll Date" name="EnrollDate" required/>
                                            </div>
                                            
                                          </div>
                                          <div class="form-group">
                                            <label class="label-control" for="id_start_datetime">End Date and Time:</label>
                                            <div class="" >
                                              <input type="datetime-local" value="" class="form-control" placeholder="Enter Enroll Date" name="EnrollDate" required/>
                                            </div>
                                            
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-1 text-end">
                                <button class="btn bg-gradient-success mb-4" type="submit"></i>&nbsp;&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script> 
function generateRandomPin() {
    const pinLength = 4;
    const pin = generateRandomPinString(pinLength);
    document.getElementById('pinOutput').innerText = `Generated PIN: ${pin}`;
    
    // Set the generated PIN to the input field and make it readonly
    document.getElementById('inputPin').value = pin;
    document.getElementById('inputPin').readOnly = true;
}

function generateRandomPinString(length) {
    const characters = '0123456789';
    let pin = '';

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        pin += characters[randomIndex];
    }

    return pin;
}

function resetInput() {
    // Reset the input field and make it editable
    document.getElementById('inputPin').value = '';
    document.getElementById('inputPin').readOnly = false;
}

</script>