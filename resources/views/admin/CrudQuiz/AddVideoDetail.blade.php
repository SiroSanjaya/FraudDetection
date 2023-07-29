@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">Add Courses > Title Courses </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0" href="{{ 'ManageCourses' }}"><i
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
                        <form action="{{ route('AddedVideoDetail', ['id' => $videos->Video_Id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- Input None --}}
                            <input type="text" name="Thumbnail" id="Thumbnail" style="display: none">
                            {{--  --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex justify-content-center">
                                            <img src="" alt="" id="previewImageLink"
                                                style="border-radius: 15px; width:400px;height:200px;object-fit:contain;display:none">
                                        </div>
                                        <div class="form-group d-flex justify-content-center">
                                            <img src="" alt="" id="previewImage"
                                                style="border-radius: 15px; width:400px;height:200px;object-fit:contain;display:none">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Video Link</label>
                                            <input class="form-control " type="text" placeholder="Enter your Video Link"
                                                id="imageLink" name="VideoLink">
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
                                            <label for="example-text-input" class="form-control-label">Video Name</label>
                                            <input class="form-control " type="text" placeholder="Enter your Video Name"
                                                name="VideoName">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Video
                                                Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="VideoDesc"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="customFile">Custom Thumbnail Video</label>
                                            <input type="file" class="form-control" id="formFile"
                                                name="CustomThumbnail" />
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

    {{-- Upload Image --}}
    <script>
        const fileInput = document.getElementById('formFile');
        const previewImage = document.getElementById('previewImage');
        const imageLinkInput = document.getElementById('imageLink');
        const thubnail = document.getElementById('Thumbnail');
        const previewImageLink = document.getElementById('previewImageLink');

        function getThumbnailFromLink(link) {
            if (link.startsWith('https://you') || link.startsWith('https://m')) {
                // YouTube Link
                var videoId = link.substring(link.lastIndexOf('/') + 1);
                return `https://img.youtube.com/vi/${videoId}/mqdefault.jpg`;
            } else if (link.startsWith('https://drive')) {
                // Google Drive Link
                var fileId = link.split('/')[5];
                return `https://drive.google.com/thumbnail?id=${fileId}`;
            } else {
                // Return the original link if it's not a YouTube or Google Drive link
                return link;
            }
        }


        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImageLink.style.display = 'none';
                previewImage.style.display = 'block';
            }

            reader.readAsDataURL(file);
        });

        imageLinkInput.addEventListener('input', function() {
            const imageLink = getThumbnailFromLink(imageLinkInput.value);
            previewImageLink.src = imageLink;
            previewImageLink.style.display = 'block';
            thubnail.value = imageLink
        });
    </script>
@endsection
