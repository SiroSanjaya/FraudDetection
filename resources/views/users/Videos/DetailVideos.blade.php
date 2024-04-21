@extends('users.layout.layout')
@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-lg-5 col-12 mb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route ("VideosUser")}}">Videos</a></li>

                        <li class="breadcrumb-item active" aria-current="page">{{ $Videos->Video_Title }}</li>
                    </ol>
                </nav>

                <h2 class="text-white">Introduction to <br> {{ $Videos->Video_Title }}</h2>

                <div class="d-flex align-items-center mt-5">
                    <a href="{{ $Videos->Video_Link }}" class="btn custom-btn custom-border-btn smoothscroll me-4">Watch More</a>

                    <a href="#top" class="custom-icon bi-bookmark smoothscroll"></a>
                </div>
            </div>

            <div class="col-lg-5 col-12">
                <div class="topics-detail-block bg-white shadow-lg">
                    <img src="{{ asset('storage/uploads/thumbnail/'. $Videos->Video_Title .  '/images/' . $Videos->Video_Thumbnail) }}" class="topics-detail-block-image img-fluid">
                </div>
            </div>

        </div>
    </div>
</header>


<section class="topics-detail-section section-padding" id="topics-detail">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 m-auto">
                <h3 class="mb-4">Introduction to {{ $Videos->Video_Title }}</h3>

                <p>{{ $Videos->Video_Desc }}</p>

                <p><strong>There are so many ways to make money online</strong>. Below are several platforms you can use to find success. Keep in mind that there is no one path everyone can take. If that were the case, everyone would have a million dollars.</p>

                <blockquote>
                    Freelancing your skills isn’t going to make you a millionaire overnight.
                </blockquote>

             

        </div>
    </div>
</section>



</main>
@endsection