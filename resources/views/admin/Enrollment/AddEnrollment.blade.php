@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Add Enrollment</h4> 
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
                        <h6>Enrollment Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('AddedEnrollment') }}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <select id="courses" class="form-control" name="CategoryCourses">
                                                <option value="">Select Courses</option>
                                                @foreach ($CategoryCourses as $c)
                                                    <option value="{{ $c->Category_Id }}">{{ $c->Category_Name }}</option>
                                                @endforeach
                                            </select>
                                            @error('CategoryCourses')
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
                                            <label for="example-text-input" class="form-control-label">Enrollment Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Your Enrollment Title" name="EnrollmentTitle">
                                            @error('EnrollmentTitle')
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
                                            <label for="example-text-input" class="form-control-label">Enrollment Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Your Enrollment Desc"
                                                rows="3" name="EnrollmentDesc"></textarea>
                                            @error('EnrollmentDesc')
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
                                            <div class="form-group">
                                                <label for="input_from">From</label>
                                                <input type="text" class="form-control" id="input_from"
                                                    placeholder="Start Date" name="EnrollmentStart" readonly>
                                            </div>
                                            @error('EnrollmentStart')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="input_from">To</label>
                                                <input type="text" class="form-control" id="input_to"
                                                    placeholder="End Date" name="EnrollmentEnd" readonly>
                                            </div>
                                            @error('EnrollmentEnd')
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
                                            <label class="form-label" for="customFile">Certificate</label>
                                            <input type="file" class="form-control" id="PreviewImageInput"
                                                name="Certificate" />
                                            @error('Certificate')
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
@endsection
