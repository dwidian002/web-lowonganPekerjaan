<nav class="navbar navbar-expand-lg navigation" id="navbar">
    <div class="container">
          <a class="navbar-brand" href="index.html">
              <img src="layout/assets/images/logo.png" alt="" class="img-fluid">
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
        <a href="{{url('/logout')}}" class="custom-btn login-btn">
            <i class="fa fa-user"></i> Dashboard
        </a>
            @if (auth()->user()->role == 'applicant')
                <a href="{{ route('profile-applicant') }}" class="custom-btn login-btn" data-role="applicant">
                    <i class="icofont-user"></i> Profile
                </a>
                @elseif (auth()->user()->role == 'company')
                <a href="{{ route('profile-company') }}" class="custom-btn login-btn" data-role="company">
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
        /* Reduced padding for a smaller button */
        font-size: 14px;
        /* Smaller font size */
        background-color: white;
        border: 2px solid #008000;
        /* Green border for register */
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: bold;
        color: #008000;
        /* Green text */
        margin-right: 5px;
        /* Reduced space between buttons */
    }

    .custom-btn i {
        background-color: #008000;
        /* Green background for icon */
        color: white;
        padding: 7px;
        /* Smaller icon padding */
        border-radius: 50%;
        margin-right: 8px;
        font-size: 14px;
        /* Adjust the icon size */
    }

    .custom-btn:hover {
        background-color: #008000;
        /* Green background on hover */
        color: white;
        /* White text on hover */
        border-color: #008000;
    }

    .custom-btn:hover i {
        background-color: white;
        /* White background for icon on hover */
        color: #008000;
        /* Green icon color on hover */
    }

    /* Additional styles to differentiate login button */
    .login-btn {
        border-color: #0056b3;
        /* Blue border for login */
        color: #0056b3;
        /* Blue text */
    }

    .login-btn i {
        background-color: #0056b3;
        /* Blue background for icon */
    }

    .login-btn:hover {
        background-color: #0056b3;
        /* Blue background on hover */
        color: white;
        border-color: #0056b3;
    }

    .login-btn:hover i {
        background-color: white;
        color: #0056b3;
    }

    /* Mengubah tampilan tombol register menjadi hijau penuh */
    .register-btn {
        background-color: #008000;
        /* Hijau penuh */
        color: white;
        /* Teks putih */
        border-color: #008000;
        /* Border hijau */
    }

    /* Mengubah ikon dalam tombol register */
    .register-btn i {
        background-color: white;
        /* Latar belakang putih untuk ikon */
        color: #008000;
        /* Warna ikon hijau */
    }

    /* Hover effect untuk tombol register */
    .register-btn:hover {
        background-color: white;
        /* Latar belakang putih saat hover */
        color: #008000;
        /* Warna teks hijau saat hover */
        border-color: #008000;
        /* Border hijau */
    }

    .register-btn:hover i {
        background-color: #008000;
        /* Warna latar belakang ikon hijau saat hover */
        color: white;
        /* Warna ikon putih saat hover */
    }

    /* Styling untuk dropdown menu */
    .dropdown-menu {
        border-radius: 8px;
        /* Membuat border dropdown lebih halus */
        border: 1px solid #ccc;
        /* Border tipis pada dropdown */
        padding: 5px 0;
    }

    .dropdown-item {
        color: #0056b3;
        /* Warna teks dropdown */
        font-size: 14px;
        padding: 10px 20px;
        /* Spacing yang lebih besar */
        transition: background-color 0.3s ease;
    }

    /* Hover effect untuk item dropdown */
    .dropdown-item:hover {
        background-color: #f1f1f1;
        /* Latar belakang abu-abu muda saat hover */
        color: #008000;
        /* Warna teks hijau saat hover */
    }
</style>
        </ul>
      </div>
    </div>
</nav>