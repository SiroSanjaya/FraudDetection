<nav class="navbar navbar-expand-lg">
  <div class="container">
      <a class="navbar-brand" href="{{ route('HomeUser') }}">
     
          <span>eFishery</span>
      </a>

      <div class="d-lg-none ms-auto me-4">
          <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-lg-5 me-lg-auto">
              <li class="nav-item">
                  <a class="nav-link click-scroll" href="{{ route('HomeUser') }}">Home</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link click-scroll" href="#section_2">Browse Topics</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link click-scroll" href="#section_3">How it works</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link click-scroll" href="#section_4">FAQs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link click-scroll" href="{{ route('VideosUser') }}">Videos</a>
            </li>
              
          </ul>

          <div class="d-none d-lg-block">
              <a href="#top" class="navbar-icon bi-person smoothscroll"> </a>
          </div>
      </div>
  </div>
</nav>