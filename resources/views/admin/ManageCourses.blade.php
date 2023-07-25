@extends('admin.layout.layout')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-6 ">
                    <h4 class="text-capitalize">Manage Courses</h4>
                </div>
                <div class="col-6 text-end">
                  <a class="btn bg-gradient-success mb-0" href="{{ route('AddCourses') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
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
            <h6>Courses</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <div class="card-body p-3">
                    <div class="row" >
                      <div class="col-md-4  " >
                        <div class="card card-profile">
                            <img src="images/bg.png" alt="Image placeholder" class="card-img-top">
                            <div class="row justify-content-center">
                              <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                  <a href="javascript:;">
                                    <img src="images/logo.png" class="rounded-circle img-fluid border border-2 border-white">
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="card card-profile">
                            <img src="images/bg.png" alt="Image placeholder" class="card-img-top">
                            <div class="row justify-content-center">
                              <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                  <a href="javascript:;">
                                    <img src="images/logo.png" class="rounded-circle img-fluid border border-2 border-white">
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card card-profile">
                            <img src="images/bg.png" alt="Image placeholder" class="card-img-top">
                            <div class="row justify-content-center">
                              <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                  <a href="javascript:;">
                                    <img src="images/logo.png" class="rounded-circle img-fluid border border-2 border-white">
                                  </a>
                                </div>
                              </div>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  </div>
                      </div>
                    </div>


            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
