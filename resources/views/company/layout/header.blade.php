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
          <li class="nav-item"><a class="nav-link" href="{{route('job-posting.index')}}">Job Postings</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('application.index')}}">Applications</a></li>
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
        <a href="{{url('/logout')}}" class="custom-btn login-btn">
            <i class="fa fa-user"></i> Dashboard
        </a>
            @if (auth()->user()->role == 'company')
            <a href="{{ route('company.profile') }}" class="custom-btn login-btn" data-role="company">
                <i class="icofont-user"></i> Profile
            </a>
            @endif
        @endif
    </div>
    </div>
</nav>
<style>
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