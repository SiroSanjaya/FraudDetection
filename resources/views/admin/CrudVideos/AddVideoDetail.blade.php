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
                                    <a href="{{ route('ManageVideos') }}">Manage Video ></a>
                                    <a href="{{ route('VideoDetail', ['courses' => $courses->Courses_Title]) }}">{{ $courses->Courses_Title }}
                                        ></a>
                                    Add Videos
                                </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0"
                                    href="{{ route('VideoDetail', ['courses' => $courses->Courses_Title]) }}"><i
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
                        <h6>Video Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('AddedVideoDetail', ['courses' => $courses->Courses_Title]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- Input None --}}
                            <input type="text" name="Thumbnail" id="Thumbnail" style="display: none">
                            {{--  --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex justify-content-center">
                                            <img src="" alt="" id="previewImageLink">
                                        </div>
                                        <div class="form-group d-flex justify-content-center">
                                            <img src="" alt="" id="PreviewImage">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Courses</label>
                                            <input class="form-control " type="text" name="Courses"
                                                value="{{ $courses->Courses_Title }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Video Title</label>
                                            <input class="form-control " type="text" placeholder="Enter your Video Name"
                                                name="VideoName">
                                            @error('VideoName')
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
                                            <label for="example-text-input" class="form-control-label">Video
                                                Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="VideoDesc" placeholder="Enter Your Video Description"></textarea>
                                            @error('VideoDesc')
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
                                            <label for="example-text-input" class="form-control-label">Video Link</label>
                                            <input class="form-control " type="text" placeholder="Enter your Video Link"
                                                name="VideoLink" id="imageLink">
                                            @error('VideoLink')
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
                                            <label class="form-label" for="customFile">Custom Thumbnail Video</label>
                                            <input type="file" class="form-control" id="PreviewImageInput"
                                                name="CustomVideoThumbnail" />
                                            @error('CustomVideoThumbnail')
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
