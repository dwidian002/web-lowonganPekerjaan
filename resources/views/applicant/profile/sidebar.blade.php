<div class="profile-sidebar">
    <div class="profile-avatar-section">
        <div class="avatar-container">
            @if ($applicantProfile && $applicantProfile->foto)
                <img src="{{ asset('storage/' . $applicantProfile->foto) }}" alt="{{ $applicantProfile->name }}" class="profile-avatar">
            @else
                <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" alt="Default Foto" class="profile-avatar">
            @endif
        </div>
        <div class="profile-name-container">
            <h3 class="profile-name">{{ $applicantProfile->name ?? 'Name Not Available' }}</h3>
            <p class="profile-email">{{ $applicantProfile->user->email ?? 'Email Not Available' }}</p>
        </div>
    </div>

    <nav class="profile-navigation">
        <div class="nav-menu">
            <a href="{{ route('application.my-application') }}" class="nav-item {{ request()->routeIs('application.my-application') ? 'active' : '' }}">
                <i class="icofont-ui-folder"></i>
                <span>My Application</span>
            </a>
            <a href="{{ route('profile-applicant') }}" class="nav-item {{ request()->routeIs('profile-applicant') ? 'active' : '' }}">
                <i class="icofont-user"></i>
                <span>Personal Info</span>
            </a>
            <a href="{{ route('profile-more-info') }}" class="nav-item {{ request()->routeIs('profile-more-info') ? 'active' : '' }}">
                <i class="icofont-briefcase"></i>
                <span>More Information</span>
            </a>
            <a href="{{ route('logout') }}" class="nav-item {{ request()->routeIs('logout') ? 'active' : '' }}">
                <i class="icofont-logout"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>
</div>