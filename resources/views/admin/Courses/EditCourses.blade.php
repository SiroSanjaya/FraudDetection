@extends('admin.layout.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-6 ">
                    <h4 class="text-capitalize">{{ $CategoryCourses->Category_Name }} > {{ $courses->Courses_Title }} > Edit Courses </h4>
                </div>
                <div class="col-6 text-end">
                  <a class="btn bg-gradient-success mb-0" href="{{ route('Courses', ['category' => $CategoryCourses->Category_Name]) }}"><i class="fas fa-sign-out"></i>&nbsp;&nbsp;Back</a>
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
            <h6>Courses Information</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body">
              <form action="{{ route('EditedCourses', ['category' => $CategoryCourses->Category_Name , 'id' => $courses->Courses_Id]) }}" method="POST" enctype="multipart/form-data">
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
                      <label for="example-text-input" class="form-control-label">Course Title</label>
                      <input class="form-control " type="text" placeholder="Enter your Course Title" value="{{ $courses->Courses_Title }}" name="CoursesTitle">
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Course Description</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Enter your Course Description" name="CoursesDesc">{{ $courses->Courses_Desc }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Course Module</label>
                        <input class="form-control" type="text" placeholder="Https//" value="{{ $courses->Courses_Module }}" name="CoursesModule">
                      </div>
                  </div>
                  <div class="col-md-6">
                  
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="customFile">Course Image</label>
                        <input type="file" class="form-control" id="PreviewImageInput"  name="CoursesImage"/>
                    </div>
                  </div>
                  
                  </div>
                </div>
                
                <div class="col-1 text-end">
                  <button type="submit" class="btn bg-gradient-success mb-2"></i>&nbsp;&nbsp;Submit</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
