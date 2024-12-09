@extends('company.layout.main')

@section('content')
<section class="profile-section">
    <div class="container">
        <div class="profile-wrapper">
            <div class="profile-sidebar">
                <div class="profile-avatar-section">
                    <div class="avatar-container">
                        @if ($companyProfile && $companyProfile->logo)
                            <img src="{{ asset('storage/' . $companyProfile->logo) }}" alt="{{ $companyProfile->name }}" class="profile-avatar">
                        @else
                            <img src="{{ asset('layout/assets/images/service/default-logo.png') }}" alt="Default logo" class="profile-avatar">
                        @endif
                    </div>
                    <div class="profile-name-container">
                        <h3 class="profile-name">{{ $companyProfile->company_name ?? 'Name Not Available' }}</h3>
                        <p class="profile-email">{{ $companyProfile->user->email ?? 'Email Not Available' }}</p>
                    </div>
                </div>
    
                <nav class="profile-navigation">
                    <div class="nav-menu">
                        <a href="{{route('profile-company')}}" class="nav-item active">
                            <i class="fas fa-user"></i>
                            <span>Personal Info</span>
                        </a>
                        <a href="{{ route('logout') }}" class="nav-item">
                            <i class="icofont-logout"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </nav>
            </div>
            <main class="profile-content">
                <section id="personal-info" class="profile-section">
                    <div class="section-header">
                        <h2>Personal Information</h2>
                        <a href="{{route('profile-company.edit', $companyProfile->id)}}" class="btn-edit-profile">
                            <i class="icofont-edit"></i> Edit
                        </a>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-card">
                            <label>Company Name</label>
                            <div class="info-value">{{ $companyProfile->company_name ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <label>Industry</label>
                            <div class="info-value">{{ $applicantProfile->gender ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <label>Website</label>
                            <div class="info-value">{{ $companyProfile->website ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <label>Type Of Company</label>
                            <div class="info-value">{{ $companyProfile->typeCompany->name ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <label>Founded in</label>
                            <div class="info-value">{{ $companyProfile->tahun_berdiri ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <label>Location</label>
                            <div class="info-value">{{ $companyProfile->location->name ?? '-' }}</div>
                        </div>
                        <div class="info-card full-width">
                            <label>Address</label>
                            <div class="info-value">{{ $companyProfile->alamat_lengkap ?? '-' }}</div>
                        </div>
                        <div class="info-card full-width">
                            <label>Description</label>
                            <div class="info-value">{{ $companyProfile->description ?? '-' }}</div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</section>

<style>
    :root {
        --color-primary: #2c3e50;
        --color-secondary: #34495e;
        --color-accent: #db3434;
        --color-background: #f4f6f7;
        --color-text-dark: #2c3e50;
        --color-text-light: #ffffff;
        --transition-speed: 0.3s;
        --border-radius: 12px;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--color-background);
        line-height: 1.6;
        color: var(--color-text-dark);
    }
    
    .profile-container {
        max-width: 1200px;
        margin: 1.5rem auto;
        padding: 0.5rem;
    }
    
    .profile-wrapper {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 1.5rem;
        background-color: var(--color-text-light);
        border-radius: var(--border-radius);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .profile-sidebar {
        background: linear-gradient(145deg, var(--color-primary), var(--color-secondary));
        color: var(--color-text-light);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
    }
    
    .profile-avatar-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .avatar-container {
        position: relative;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid var(--color-text-light);
        margin-bottom: 1rem;
        transition: transform var(--transition-speed) ease;
    }
    
    .avatar-container:hover {
        transform: scale(1.05);
    }
    
    .profile-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-name-container {
        text-align: center;
    }
    
    .profile-name {
        font-size: 1.2rem;
        color: var(--color-text-light);
        margin-bottom: 0.3rem;
    }
    
    .profile-email {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.7);
        margin-bottom: 1rem;
    }
    
    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.7rem 1rem;
        color: var(--color-text-light);
        text-decoration: none;
        border-radius: 6px;
        transition: background-color var(--transition-speed);
    }
    
    .nav-item:hover, .nav-item.active {
        background-color: rgba(255,255,255,0.2);
    }
    
    .nav-item i {
        font-size: 1.1rem;
        width: 1.3rem;
        text-align: center;
    }
    
    .profile-content {
        padding: 1.5rem;
        overflow-y: auto;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--color-background);
    }
    
    .section-header h2 {
        font-size: 1.3rem;
        color: var(--color-primary);
    }
    
    .btn-edit-profile {
        background-color: var(--color-accent);
        color: var(--color-text-light);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        transition: all var(--transition-speed);
    }
    
    .btn-edit-profile:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    
    .profile-section {
        background-color: var(--color-text-light);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .info-card {
        background-color: var(--color-background);
        padding: 1rem;
        border-radius: 8px;
    }
    
    .info-card.full-width {
        grid-column: span 2;
    }
    
    .info-card label {
        display: block;
        margin-bottom: 0.3rem;
        color: var(--color-text-dark);
        font-weight: 600;
        opacity: 0.7;
        font-size: 0.9rem;
    }
    
    .info-value {
        font-size: 0.95rem;
        color: var(--color-text-dark);
    }
    
    @media (max-width: 768px) {
        .profile-wrapper {
            grid-template-columns: 1fr;
        }
    
        .info-grid {
            grid-template-columns: 1fr;
        }
    
        .info-card.full-width {
            grid-column: span 1;
        }
    }
</style>
@endsection