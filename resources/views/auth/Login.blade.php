<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
  rel="stylesheet"
/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-image">

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img style=""src="images/icon.gif"
          class="icon" alt="Phone image">
      </div >
      <div class="col-md- col-lg-5 offset-xl-1">
 <center>
        <img src="/images/logo.png"
          class="img-fluid" alt="Phone image"> <br>
</center>

<!-- Push Back-end  -->
  <div class="login">
  <p class=" fw-bold ">Login </p> <p class="  "> eFishery Warden</p><br>
  <a href="{{ route('google-auth') }}">
    <button type="button" class="login-with-google-btn" >
    Sign in with Google
  </button>
  </a>
  </div>


</section>
</body>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
></script>
</html>
