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
                                    <a href="{{ route('ManageEnrollment') }}">Manage Enrollment</a> > 
                                    <a href="{{ route('DetailEnrollment', ['category' => $enrollment->Enrollment_Title]) }}">Detail Enrollment</a>
                                    > Add User
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
                    <div class="card-header pb-0">
                        <h6>Add User To Enrollment</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('EditedDetailEnrollment', ['category' => $enrollment->Enrollment_Title, 'id' => $enroll->Enroll_Id]) }}" method="post" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Enrollment Category</label>
                                        <div class="form-group">
                                            <select class="js-select2" name="EnrollmentID">
                                                @foreach ($allenrollment as $e)
                                                    <option value="{{ $e->Enrollment_Id }}" data-badge="">{{ $e->Enrollment_Title }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                        <label for="example-text-input" class="form-control-label">Users</label>
                                        <div class="form-group">
                                            <select class="js-select2" name="Users[]">
                                                @foreach ($users as $u)
                                                    <option value="{{ $u->User_Id }}" data-badge="">{{ $u->username }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Users')
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
                                            <label class="label-control" for="id_start_datetime">Enroll Date</label>
                                            <div class="input-group date" id="id_0">
                                              <input type="text" value="" class="form-control" placeholder="Enter Enroll Date" name="EnrollDate" value="{{ $enroll->Enroll_Date }}"/>
                                            </div>
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
@endsection
