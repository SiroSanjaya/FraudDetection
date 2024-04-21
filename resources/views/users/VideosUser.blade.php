@extends('users.layout.layout')
<main>

  


    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-5 col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Homepage</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Topics Listing</li>
                        </ol>
                    </nav>

                    <h2 class="text-white">Topics Listing</h2>
                </div>

            </div>
        </div>
    </header>


    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h3 class="mb-4">Popular Topics</h3>
                </div>
                @foreach ($courses as $c)
                <div class="col-lg-6 col-md-6 col-12 mt-lg-3">
                    <div class="custom-block custom-block-overlay">
                        <div class="d-flex flex-column h-100">
                            <img src="{{ asset('storage/uploads/courses/images/' . $c->Courses_Image) }}" class="custom-block-image img-fluid" alt="">

                            <div class="custom-block-overlay-text d-flex">
                                <div>
                                    <h5 class="text-white mb-2">{{ $c->Courses_Title }}</h5>

                                    <p class="text-white">{{ $c->Courses_Desc}}</p>

                                    <a href="{{ route('ShowVideos', ['courses' => $c->Courses_Title]) }}" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                </div>

                                <span class="badge bg-finance rounded-pill ms-auto">{{ $c->Courses_Id }}</span>
                            </div>

                            <div class="social-share d-flex">
                                <p class="text-white me-4">                                                                                                                                                                                                                                 </p>

                           
                                <a href="#" class="custom-icon  ms-auto"><i class="fa-regular fa-bookmark fa-2xl" style="color: #ffffff;"></i></a>
                            </div>

                            <div class="section-overlay"></div>
                        </div>
                    </div>
                </div>
                @endforeach
              
                  
                <div class="col-lg-12 col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">Prev</span>
                                </a>
                            </li>

                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">1</a>
                            </li>
                            
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="#">5</a>
                            </li>
                            
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </section>


 
</main>

