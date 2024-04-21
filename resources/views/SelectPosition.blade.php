@extends('layout.layout')
@section('content')
    <div class="back">
        <a href="{{ route('login') }}">
            <i class="fa-thin fa-arrow-left-long text-white mt-5 ms-5"></i>
        </a>
    </div>
    <section class="bisnis_unit">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                  <h1 class="card-title " style="color: black" >Tell us about your
                    Position</h1> <br>
                    <div class="icon_mobile">
                        <img style=""src="images/icon_mobile.png"
                          class="icon" alt="Phone image">
                      </div >
                    <h5 style="color: "> What’s your Position?</h5>
                  <div class="form-outline mb-4">
                    <form action="{{ route('SelectedPosition') }}"
                    class="d-flex justify-content-center flex-column w-100 pt-3" method="POST">
                    @csrf
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="Position">
                      <option value="" disabled selected>Select Position</option>
                      @foreach ($role as $c)
                          @if ($c->role_name !== 'admin')  <!-- Hide the option if role_name is 'Admin' -->
                              <option value="{{ $c->role_Id }}">{{ $c->role_name }}</option>
                          @endif
                      @endforeach  
                  </select>
                  
                    <button class="btn btn-lg btn-block btn-primary" style="background-color: #1E4A58;"
                    type="submit"> Continue</button>

                </form>
                  </div>



                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

