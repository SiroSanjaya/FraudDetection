@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid py-4">
        {{-- {{dd($quiz)}} --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 ">
                                <h4 class="text-capitalize">
                                    <a href="{{ route('ManageQuiz') }}">Manage Quiz ></a>
                                    <a href="{{ route('Quiz', ['courses' => $courses->Courses_Title]) }}">{{ $courses->Courses_Title }}
                                        ></a>
                                    Add Question
                                </h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-success mb-0"
                                    href="{{ route('QuizDetail', ['courses' => $courses->Courses_Title, 'id' => $quiz->Quiz_Id]) }}"><i
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
                    <div class="card-header pb-0 text-center">
                        <h6>Question Quiz</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('AddedQuestion', ['courses' => $courses->Courses_Title, 'id' => $quiz->Quiz_Id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Question</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Your Quiz Description" rows="3"
                                                name="Question"></textarea>
                                            @error('Question')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Option 1</label>
                                            <input class="form-control " type="text" placeholder="Enter Option 1"
                                                name="Option[]">
                                            @error('Option[]')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Option 2</label>
                                            <input class="form-control " type="text" placeholder="Enter Option 2"
                                                name="Option[]">
                                            @error('Option[]')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Option 3</label>
                                            <input class="form-control " type="text" placeholder="Enter Option 3"
                                                name="Option[]">
                                            @error('Option[]')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Option 4</label>
                                            <input class="form-control " type="text" placeholder="Enter Option 4"
                                                name="Option[]">
                                            @error('Option[]')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Answere</label>
                                            <input class="form-control " type="text" placeholder="Tell The Answere"
                                                name="Answere">
                                            @error('Answere')
                                                <div class="mb-3">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button class="btn bg-gradient-success mb-2 w-75" type="submit"></i>&nbsp;&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
