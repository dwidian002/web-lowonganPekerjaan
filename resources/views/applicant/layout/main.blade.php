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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Load jQuery first -->
  <script src="{{ asset('layout/assets/plugins/jquery/jquery.js') }}"></script>
  <!-- jQuery Easing (dipindah setelah jQuery) -->
  <script src="{{ asset('layout/assets/plugins/counterup/jquery.easing.js') }}"></script>
</head>

<style>

    .service-item .icon {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .service-item .icon i {
        color: #2c4187;
        font-size: 2.5rem;
        transition: transform 0.3s ease;
    }

    .service-item:hover .icon i {
        transform: scale(1.1);
    }

    .service-item .icon h4 {
        margin: 0;
        color: #2c4187;
        transition: color 0.3s ease;
    }

    .service-item:hover .icon h4 {
        color: #d81c44;
    }

    .service-item {
    position: relative;
    transition: all 0.3s ease;
    overflow: hidden;
}

.service-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(0,123,255,0.1), transparent);
    transition: all 0.5s ease;
}

.service-item:hover::before {
    left: 100%;
}

.service-item .icon {
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.3s ease;
}

.service-item:hover .icon {
    transform: translateX(5px);
}
.service-item {
    position: relative;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.service-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, 
        rgba(0,123,255,0.1) 0%, 
        transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
    }

    .service-item:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .service-item:hover::after {
        opacity: 1;
    }

    .service-item .icon {
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.4s ease;
    }

    .service-item:hover .icon i {
        transform: rotate(15deg) scale(1.2);
        color: #d81c44;
    }

    .service-item .icon h4 {
        margin: 0;
        transition: all 0.4s ease;
    }

    .service-item:hover .icon h4 {
        transform: translateX(10px);
        color: #d81c44;
    }

    .job-title-link:hover {
        color: #e82454;
    }

    .btn-container {
        margin-bottom: 1rem;
    }

    .btn-main-2 {
        display: inline-flex;
        align-items: center;
        padding: 12px 30px;
        background-color: #d11843;
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-main-2:hover {
        background-color: #1a2f5a;
        color: white;
        text-decoration: none;
    }

    .btn-icon {
        position: relative;
    }

    .btn-round-full {
        border-radius: 50px;
    }

    .icofont-simple-right {
        margin-left: 0.5rem;
        font-size: 14px;
    }

    .btn-main-2 i {
        display: inline-flex;
        align-items: center;
    }

    .text-uppercase {
        text-transform: uppercase;
    }

    .text-sm {
        font-size: 14px;
    }

    .letter-spacing {
        letter-spacing: 1px;
    }

    .text-dark {
        color: #333;
    }

    h1 {
        font-weight: bold; 
        margin-bottom: 1rem;
        margin-top: 1rem;
    }

    p {
        color: #333;
    }

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

    .company-name-link {
        text-decoration: none;
    }

    .company-name {
        color: #333;
        font-size: 1.5rem !important;
        font-weight: 600;
        line-height: 1.2;
        margin-bottom: 0;
        transition: color 0.2s ease;
    }

    .company-name:hover {
        color: #e82454;
        text-decoration: none;
    }

    .position {
        color: #333;
        font-size: 1.5rem !important;
        font-weight: 600;
        line-height: 1.2;
        margin-bottom: 0;
        transition: color 0.2s ease;
    }

    .position:hover {
        color: #e82454;
        text-decoration: none;
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

    .text-primary {
        color: #223a66 !important;
        font-weight: bold;
    }

    .text-small {
        color: #223a66 !important;
        font-weight: bold;
    }
    
</style>

<body id="top">



<header>
    @include('applicant.layout.header')
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
   