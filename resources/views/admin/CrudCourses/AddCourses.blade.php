@extends('admin.layout.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-6 ">
                    <h4 class="text-capitalize">Add Courses</h4>
                </div>
                <div class="col-6 text-end">
                  <a class="btn bg-gradient-success mb-0" href="javascript:;"><i class="fas fa-sign-out"></i>&nbsp;&nbsp;Back</a>
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
            <h6>Videos</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Username</label>
                      <input class="form-control " type="text" value="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Email address</label>
                      <input class="form-control" type="email" value="jesse@example.com">
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="customFile">Default file input example</label>
                        <input type="file" class="form-control" id="customFile" />
                    </div>
                  </div>
                  
                  
                  </div>
                </div>
                        


            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
