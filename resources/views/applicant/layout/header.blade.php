<nav class="navbar navbar-expand-lg navigation" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="layout/assets/images/logo.png" alt="" class="img-fluid" style="max-width: 180px; height: auto;">
        </a>

          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icofont-navigation-menu"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarmain">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">Home</a>
          </li>
           <li class="nav-item"><a class="nav-link" href="{{route('job-postings.all')}}">All Job</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('list.company')}}">Companies</a></li>
           <li class="nav-item"><a class="nav-link" href="contact.html">About us</a></li>
        </div>
        @if(!auth()->check())
        <a href="{{url('/login')}}" class="custom-btn login-btn">
            <i class="icofont-user"></i> Login
        </a>
        <div class="nav-item dropdown">
            <a class="custom-btn dropdown-toggle register-btn" href="#" role="button" data-bs-toggle="dropdown" id="registerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icofont-plus"></i> Register
            </a>
            <div class="dropdown-menu" aria-labelledby="registerDropdown">
                <a class="dropdown-item" href="{{ url('register/company') }}">As Company</a> <!-- Redirect ke form Company -->
                <a class="dropdown-item" href="{{ url('register/applicant') }}">As Applicant</a> <!-- Redirect ke form Applicant -->
            </div>
        </div>
        @else
        <a href="#" class="custom-btn login-btn" id="dashboard-btn">
            <i class="icofont-ui-home"></i> Dashboard
        </a>
            @if (auth()->user()->role == 'applicant')
                <a href="{{ route('profile-applicant') }}" class="custom-btn login-btn" data-role="applicant">
                    <i class="icofont-user"></i> Profile
                </a>
            @endif
        @endif
    </div>
    </div>
</nav>
<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-header">
            <h3>Applicant Menu</h3>
            <button class="close-btn" id="close-sidebar">
                <i class="icofont-close"></i>
            </button>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Data diri</a></li>
            <li><a href="#">Status lamaran</a></li>
            <li><a href="#">Layout</a></li>
        </ul>
    </div>
</div>
<script>
    const dashboardBtn = document.getElementById('dashboard-btn');
    const closeSidebarBtn = document.getElementById('close-sidebar');
    const sidebar = document.querySelector('.sidebar');

    dashboardBtn.addEventListener('click', () => {
        sidebar.classList.add('show');
    });

    closeSidebarBtn.addEventListener('click', () => {
        sidebar.classList.remove('show');
    });
</script>
<style>

.sidebar {
        position: fixed;
        right: -100%;
        top: 0;
        bottom: 0;
        width: 300px;
        background-color: #3A3B3C;
        color: #fff;
        padding: 20px;
        transition: right 0.3s ease-in-out;
        z-index: 1000;
    }

    .sidebar.show {
        right: 0;
    }

    .sidebar-inner {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #555;
    }

    .sidebar-header h3 {
        font-size: 18px;
        font-weight: 600;
    }

    .close-btn {
        background-color: transparent;
        border: none;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
    }

    .sidebar-menu {
        list-style-type: none;
        padding: 0;
        margin-top: 20px;
    }

    .sidebar-menu li {
        margin-bottom: 10px;
    }

    .sidebar-menu li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        transition: color 0.3s ease-in-out;
    }

    .sidebar-menu li a:hover {
        color: #ccc;
    }


    
    .custom-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 15px;
        font-size: 14px;
        background-color: white;
        border: 2px solid #008000;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: bold;
        color: #008000;
        margin-right: 5px;
    }

    .custom-btn i {
        background-color: #008000;
        color: white;
        padding: 7px;
        border-radius: 50%;
        margin-right: 8px;
        font-size: 14px;
    }

    .custom-btn:hover {
        background-color: #008000;
        color: white;
        border-color: #008000;
    }

    .custom-btn:hover i {
        background-color: white;
        color: #008000;
    }

    .login-btn {
        border-color: #0056b3;
        color: #0056b3;
    }

    .login-btn i {
        background-color: #0056b3;
    }

    .login-btn:hover {
        background-color: #0056b3;
        color: white;
        border-color: #0056b3;
    }

    .login-btn:hover i {
        background-color: white;
        color: #0056b3;
    }

    .register-btn {
        background-color: #008000;
        color: white;
        border-color: #008000;
    }

    .register-btn i {
        background-color: white;
        color: #008000;
    }

    .register-btn:hover {
        background-color: white;
        color: #008000;
        border-color: #008000;
    }

    .register-btn:hover i {
        background-color: #008000;
        color: white;
    }

    .dropdown-menu {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 5px 0;
    }

    .dropdown-item {
        color: #0056b3;
        font-size: 14px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
        color: #008000;
    }
</style>
        </ul>
      </div>
    </div>
</nav>