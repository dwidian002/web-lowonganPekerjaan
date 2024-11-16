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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

    .page-title {
        position: relative;
        padding: 60px 0;
    }

    .page-title .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }

    .company-single {
        padding: 60px 0 0;
    }

    .company-logo {
        padding-right: 2rem;
    }

    .company-logo .logo-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 1px solid #eee;
        border-radius: 8px;
    }

    .company-title {
        font-size: 2.5rem;
        color: #223a66;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .company-content {
        max-height: 600px;
        overflow: auto;
    }

    .content-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        color: #223a66;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .section-text {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
    }

    .company-sidebar {
        padding-top: 3.7rem;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .sidebar-item:last-child {
        border-bottom: none;
    }

    .sidebar-item i {
        font-size: 1.2rem;
        width: 30px;
    }

    .sidebar-item a {
        color: #6c757d;
        text-decoration: none;
        word-break: break-all;
    }

    .sidebar-item a:hover {
        color: #223a66;
    }

    .job-postings {
        background-color: #f8f9fa;
        padding: 40px 0;
        margin-top: 0;
    }

    .job-card {
        transition: transform 0.2s ease-in-out;
        border-radius: 12px;
        cursor: pointer;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card .company-logo {
        display: flex;
        align-items: center;
        padding-right: 0;
    }

    .card .company-logo img {
        width: 70px !important;
        height: 70px !important;
        border: 1px solid #edf2f7;
        object-fit: cover;
        border-radius: 8px;
    }

    .company-name {
        color: #333;
        font-size: 1.5rem !important;
        font-weight: 600;
        line-height: 1.2;
        margin-bottom: 0;
        transition: color 0.2s ease;
    }

    .job-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
    }

    .job-tags .badge {
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.5em 1em;
    }

    .job-info {
        font-size: 0.9rem;
        color: #4a5568;
    }

    .job-info i {
        font-size: 1.1rem;
    }

    .card-link-wrapper {
        color: inherit;
        text-decoration: none;
    }

    .card-link-wrapper:hover {
        text-decoration: none;
        color: inherit;
    }

    .btn-outline-primary {
        border-radius: 20px;
        padding: 0.5rem 2rem;
        border-width: 2px;
        border-color: #e82454;
        color: #e82454;
    }

    .btn-outline-primary:hover {
        background-color: #e82454;
        border-color: #e82454;
        color: white;
    }

    .card-body .d-flex.align-items-center.mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .pagination {
        margin-bottom: 2rem;
    }

    .company-name-link {
        text-decoration: none;
        color: inherit;
    }

    .job-details-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .job-details-link:hover {
        text-decoration: none;
        color: inherit;
    }

    .job-details-link:hover .job-title {
        color: #e82454;
    }

    .job-content {
        cursor: pointer;
    }

    .job-card {
        transition: transform 0.2s ease-in-out;
        border-radius: 12px;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    @media (max-width: 991px) {
        .page-title {
            padding: 40px 0;
        }

        .company-single {
            padding: 40px 0 0;
        }

        .company-logo {
            text-align: center;
            padding-right: 0;
            margin-bottom: 2rem;
        }

        .company-title {
            text-align: center;
        }

        .company-sidebar {
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .job-postings {
            padding: 30px 0;
        }

        .job-card {
            margin-bottom: 1rem;
        }

        .company-name {
            font-size: 1.25rem !important;
        }
    }

    @media (max-width: 768px) {
        .company-logo .logo-img {
            width: 120px;
            height: 120px;
        }
        
        .company-title {
            font-size: 2rem;
        }
    }

    .job-card {
            transition: all 0.3s ease;
        }
        
        .card-link-wrapper {
            text-decoration: none;
            color: inherit;
        }
        
        .card-link-wrapper:hover {
            text-decoration: none;
        }
        
        .job-card .job-title {
            color: #333;
            transition: color 0.3s ease;
        }
        
        .card-link-wrapper:hover .job-title {
            color: #e82454; 
        }
        
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
</style>

<body id="top">



<header>
    @include('company.layout.header')
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
   