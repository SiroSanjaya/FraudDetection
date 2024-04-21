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
                        <h6>Edit User Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('EditedUser', ['id' => $users->User_Id]) }}" method="post" enctype="multipart/form-data">

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
                                            <input class="form-control " type="text" placeholder="{{ $users->username }} " value="{{ $users->username }}"
                                                name="username" required readonly>

                                                <div class="mb-3">

                                                </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Select Bisnis Unit</label>
                                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="BisnisUnit">
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
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Select Region</label>
                                            <select id="courses" class="form-control" name="Region">
                                                 @foreach ($Region as $b)
                                                    <option value="{{ $b->id_region }}">{{ $b->region_name }}</option>
                                                    @endforeach
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
                                            <select id="courses" class="form-control" name="Role">
                                                <option value="trainer">Trainer</option>
                                                <option value="fts">Fts</option>
                                            </select>

                                                <div class="mb-3">

                                                </div>

                                        </div>
                                    </div>

                            </div>
                            <div class="col-1 text-end">
                                <button class="btn bg-gradient-success mb-2" type="submit" onclick="showDeleteConfirmation(this)"></i>&nbsp;&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection