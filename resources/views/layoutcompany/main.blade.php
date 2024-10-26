<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
  <meta name="author" content="themefisher.com">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>WonderWoman Loker</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('layout/assets/ /favicon.ico') }}" />

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{ asset('layout/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="{{ asset('layout/assets/plugins/icofont/icofont.min.css') }}">
  <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="{{ asset('layout/assets/plugins/slick-carousel/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/assets/plugins/slick-carousel/slick/slick-theme.css') }}">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ asset('layout/assets/css/style.css') }}">

  <!-- Load jQuery first -->
  <script src="{{ asset('layout/assets/plugins/jquery/jquery.js') }}"></script>
  <!-- jQuery Easing (dipindah setelah jQuery) -->
  <script src="{{ asset('layout/assets/plugins/counterup/jquery.easing.js') }}"></script>
</head>

<style>

.feature-item {
  margin-top: -80px !important;
}

.feature-item-1 {
  margin-top: -100px !important;
}

  .search-container {
    width: 100%;
    margin-top: 20px;
}

.search-wrapper {
    display: flex;
    gap: 10px;
    align-items: center;
    width: 100%;
}

.search-input,
.select-input {
    height: 45px;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    background-color: #fff;
    font-size: 14px;
    flex: 1;
}

.select-input {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: auto;
}

.select-input {
    min-width: 150px;
    max-width: 200px;
}

.search-input {
    min-width: 200px;
    max-width: 300px;
}
</style>

<body id="top">



<header>
    @include('layoutcompany.header')
</header>

<!-- Flash Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<!-- Slider Start -->
@yield('content')

   


    <!-- 
    Essential Scripts
    =====================================-->

    
    <!-- Main jQuery -->
    <script src="{{ asset('layout/assets/plugins/jquery/jquery.js') }}"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="{{ asset('layout/assets/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('layout/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('layout/assets/plugins/counterup/jquery.easing.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('layout/assets/plugins/slick-carousel/slick/slick.min.js') }}"></script>
    <!-- Counterup -->
    <script src="{{ asset('layout/assets/plugins/counterup/jquery.waypoints.min.js') }}"></script>
    
    <script src="{{ asset('layout/assets/plugins/shuffle/shuffle.min.js') }}"></script>
    <script src="{{ asset('layout/assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
    <!-- Google Map -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
    <script src="{{ asset('layout/assets/plugins/google-map/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>    
    
    <script src="{{ asset('layout/assets/js/script.js') }}"></script>
    <script src="{{ asset('layout/assets/js/contact.js') }}"></script>

    
  </body>
  
  </html>
   