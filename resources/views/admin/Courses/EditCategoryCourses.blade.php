@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Edit Category Courses </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0" href="{{ route('ManageCourses') }}"><i
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
                        <h6>Category Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="col-md-6">
                            <div class="form-group d-flex justify-content-center">
                                <img src="" alt="" id="PreviewImage">
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <form action="{{ route('EditedCategoryCourses', ['id' => $CategoryCourses->Category_Id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <select id="courses" class="form-control" name="BisnisUnit">
                                                <label for="example-text-input" class="form-control-label">Bisnis Unit</label>
                                                <option value="{{ $CategoryCourses->Bisnis_Unit_Id }}">{{ $BisnisUnit->where('Bisnis_Unit_Id', $CategoryCourses->Bisnis_Unit_Id)->first()->Category_Name }}</option>
                                                @foreach ($BisnisUnit as $b)
                                                    <option value="{{ $b->Bisnis_Unit_Id }}">{{ $b->Bisnis_Unit_Name }}</option>
                                                @endforeach
                                            </select>
                                            @error('BisnisUnit')
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
                                            <label for="example-text-input" class="form-control-label">Category Name</label>
                                            <input class="form-control " type="text" placeholder="Enter your Category Name"
                                                name="CategoryName" value="{{ $CategoryCourses->Category_Name }}" required>
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
                                            <label for="example-text-input" class="form-control-label">Category
                                                Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Enter your Category Description"
                                                name="CategoryDesc">{{ $CategoryCourses->Category_Desc }}</textarea>
                                            @error('CategoryDesc')
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
                                            <label class="form-label" for="customFile">Category Image</label>
                                            <input type="file" class="form-control" id="PreviewImageInput"
                                                name="CategoryImage" />
                                            @error('CategoryImage')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-6 text-end d-flex justify-content-center">
                                <button type="submit" class="btn bg-gradient-success mb-2">
                                    Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
