@extends('layout.layout')
@section('content')
    <div class="back">
        <a href="{{ route('login') }}">
            <i class="fa-thin fa-arrow-left-long text-white mt-5 ms-5"></i>
        </a>
    </div>
    <div class="SelectUnit d-flex justify-content-center align-items-center text-center">
        <div class="card w-75 h-100 d-flex">
            <div class="card-body h-100 d-flex justify-content-center">
                <div class="row justify-content-md-center h-100 w-75">
                    <div class="col-sm-12">
                        <div class="top">
                            <h5 class="card-title">Tell us about your
                                Business Unit</h5>
                            <p class="card-text mt-4">What’s your Business unit name?</p>
                        </div>

                        <form action="{{ route('SelectedUnit') }}"
                            class="d-flex justify-content-center flex-column w-100 pt-3" method="POST">
                            @csrf
                            <select class="form-selec form-select-lg mb-5" aria-label=".form-select-lg example"
                                name="BisnisUnit">
                                <option value="">Select Bisnis Unit</option>
                                @foreach ($unit as $u)
                                    <option value="{{ $u->BisnisID }}">{{ $u->BisnisUnit }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn mb-3">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
