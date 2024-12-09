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
        <div class="dropdown">
            <button class="profile-btn dropdown-toggle">
                @php
                    $profileImage = 'default-logo.png';
                    $company_name = 'Company Name';
                    if (auth()->check()) {
                        $companyProfile = auth()->user()->companyProfile ?? null;
                        
                        if ($companyProfile) {
                            $profileImage = $companyProfile->logo ?? 'default-logo.png';
                            $company_name = $companyProfile->company_name ?? 'Company Name';
                        }
                    }
                @endphp
                <img src="{{ asset('storage/' . $profileImage) }}" alt="Profile" class="profile-image">
                <span class="font-semibold text-gray-700">{{ $company_name }}</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile-company') }}">
                    <i class="icofont-ui-user"></i> Profile
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="icofont-logout"></i> Logout
                </a>
            </div>
        </div>
        @endif
    </div>
    </div>
</nav>
<style>

    .navbar {
        background-color: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
        display: none;
        min-width: 200px;
        border-radius: 0.75rem;
        background-color: white;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        padding: 0.5rem 0;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .dropdown:hover .dropdown-menu,
    .dropdown-menu:hover {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        color: #4a5568;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f0f4f8;
        color: #4299e1;
        transform: translateX(5px);
    }

    .dropdown-item i {
        margin-right: 0.5rem;
        color: #4299e1;
    }

    /* Rest of the previous styles remain the same */
    .navbar-brand img {
        transition: transform 0.3s ease;
        max-height: 3rem;
    }

    .navbar-brand img:hover {
        transform: scale(1.05);
    }

    .nav-link {
        position: relative;
        color: #4a5568;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: #4299e1;
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: #4299e1;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link.active {
        color: #4299e1;
    }

    .nav-link.active::after {
        width: 100%;
        background-color: #4299e1;
    }

    .flex {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .custom-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.45rem 0.75rem;
        border-radius: 9999px;
        font-weight: 500; 
        font-size: 0.935rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .login-btn {
        border: 2px solid #4299e1;
        color: #4299e1;
        background-color: white;
    }

    .register-btn {
        background-color: #3ab943;
        color: white;
        border: 2px solid #48bb78;
    }

    .login-btn:hover {
        background-color: #4299e1;
        color: white;
    }

    .register-btn:hover {
        background-color: #38a169;
        border-color: #38a169;
    }

    .profile-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background-color: #f7fafc;
        border: 1px solid #e2e8f0;
        border-radius: 9999px;
        padding: 0.25rem 0.75rem;
        transition: all 0.3s ease;
    }

    .profile-btn:hover {
        border: 1px solid #4299e1;
        background-color: #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #4299e1;
    }

    .dropdown:hover .register-btn,
    .register-btn:hover {
        background-color: #38a169 !important;
        border-color: #38a169 !important;
    }

    .dropdown:hover .profile-btn,
    .profile-btn:hover {
        border: 1px solid #4299e1 !important;
        background-color: #e2e8f0 !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
</style>
        </ul>
      </div>
    </div>
</nav>