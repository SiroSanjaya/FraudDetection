@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">EditUser</h4> 
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0" href="{{ route('DataUser') }}"><i
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
                                            <label for="example-text-input" class="form-control-label">Username</label>
                                            <input class="form-control " type="text" placeholder="Enter your Username"
                                                name="CategoryName" required readonly>
                                          
                                                <div class="mb-3">
                                                  
                                                </div>
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Select Bisnis Unit</label>
                                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                              </select>
                                                <div class="mb-3">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Select Region</label>
                                            <select id="courses" class="form-control" name="CategoryCourses">
                                                <option value="">Select Courses</option>
                                                    <option value="">asdasd</option>
                                            </select>
                                                <div class="mb-3">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                         
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Select Role </label>
                                            <select id="courses" class="form-control" name="CategoryCourses">
                                                <option value="">FTS</option>
                                       
                                                    <option value=""></option>
                                           
                                            </select>
                                          
                                                <div class="mb-3">
                                                  
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
