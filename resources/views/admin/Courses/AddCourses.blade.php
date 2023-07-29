@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">{{ $CategoryCourses->Category_Name }} > Add Course </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0" href="{{ route('Courses', ['category' => $CategoryCourses->Category_Name]) }}"><i
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
                        <h6>Course Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="card-body">
                            <form action="{{ route('AddedCourses', ['category' => $CategoryCourses->Category_Name]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex justify-content-center">
                                            <img src="" alt="" id="PreviewImage">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Courses Title</label>
                                            <input class="form-control " type="text"
                                                placeholder="Enter Your Lesson Title" name="CoursesTitle">
                                            @error('CoursesTitle')
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
                                            <label for="exampleFormControlTextarea1">Courses Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="CoursesDesc"></textarea>
                                            @error('CoursesDesc')
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
                                            <label class="form-label" for="customFile">Courses Module</label>
                                            <input class="form-control" type="text" placeholder="https://"
                                            name="CoursesModule">
                                            @error('CoursesModule')
                                            <div class="mb-3">
                                                <p>{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="customFile">Courses Image</label>
                                                <input type="file" class="form-control" id="PreviewImageInput"
                                                    name="CoursesImage" />
                                                @error('CoursesImage')
                                                    <div class="mb-3">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-1 text-end">
                                    <button type="submit" class="btn bg-gradient-success mb-2">
                                        &nbsp;&nbsp;Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
