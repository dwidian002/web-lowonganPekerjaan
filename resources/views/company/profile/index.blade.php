@extends('company.layout.main')

@section('content')
<section class="profile-section">
    <div class="container">
        <div class="profile-header">
            <div class="profile-avatar-container">
                @if ($companyProfile && $companyProfile->logo)
                    <img src="{{ asset('storage/' . $companyProfile->logo) }}" alt="{{ $companyProfile->name }}" class="profile-avatar">
                @else
                    <img src="{{ asset('layout/assets/images/service/default-logo.png') }}" alt="Default logo" class="profile-avatar">
                @endif
            </div>
            <div class="profile-header-details">
                <h1 class="profile-name" style="color: rgb(235, 216, 216)">{{ $companyProfile->name ?? '' }}</h1>
                <p class="profile-email" style="color: rgb(235, 216, 216)">{{ $companyProfile->user->email ?? '' }}</p>
                <div class="profile-actions">
                    <a href="{{ route('logout') }}" class="btn btn-logout">Logout</a>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h2>My Profile</h2>
                    <a href="{{route('profile-company.edit', $companyProfile->id)}}" class="btn btn-edit">Edit Profile</a>
                </div>

                <div class="profile-details-grid">
                    <div class="profile-detail-item">
                        <label>Name</label>
                        <input type="text" value="{{ $companyProfile->company_name ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item">
                        <label>Industry</label>
                        <input type="text" value="{{ $companyProfile->industry->name ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item">
                        <label>Website</label>
                        <input type="text" value="{{ $companyProfile->website ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item">
                        <label>Type Of Company</label>
                        <input type="text" value="{{ $companyProfile->typeCompany->name ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item">
                        <label>Founded in</label>
                        <input type="text" value="{{ $companyProfile->tahun_berdiri ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item">
                        <label>Location</label>
                        <input type="text" value="{{ $companyProfile->location->name ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item full-width">
                        <label>Address</label>
                        <input type="text" value="{{ $companyProfile->alamat_lengkap ?? '-' }}" readonly>
                    </div>
                    <div class="profile-detail-item full-width">
                        <label>Description</label>
                        <textarea readonly>{{ $companyProfile->description ?? '-' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
:root {
    --primary-color: #012e5e;
    --secondary-color: #014b9a;
    --background-color: #f4f7f6;
    --text-color: #2c3e50;
}

.profile-section {
    background: var(--background-color);
    min-height: 100vh;
    padding: 2rem 0;
    font-family: 'Arial', sans-serif;
}

.profile-header {
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
    color: white;
    transition: transform 0.3s ease;
}

.profile-header:hover {
    transform: scale(1.02);
}

.profile-avatar-container {
    margin-right: 2rem;
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 4px solid white;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.profile-avatar:hover {
    transform: rotate(360deg);
}

.profile-header-details {
    flex-grow: 1;
}

.profile-name {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.profile-email {
    opacity: 0.8;
    margin-bottom: 1rem;
}

.btn-logout {
    background-color: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-logout:hover {
    background-color: white;
    color: var(--primary-color);
}

.profile-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    transition: box-shadow 0.3s ease;
}

.profile-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.profile-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    border-bottom: 2px solid var(--background-color);
    padding-bottom: 1rem;
}

.btn-edit {
    background-color: var(--secondary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    transition: background-color 0.3s ease;
}

.btn-edit:hover {
    background-color: #9e0000;
    color: white;
}

.profile-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.profile-detail-item {
    display: flex;
    flex-direction: column;
}

.profile-detail-item.full-width {
    grid-column: span 2;
}

.profile-detail-item label {
    margin-bottom: 0.5rem;
    color: var(--text-color);
    font-weight: bold;
}

.profile-detail-item input,
.profile-detail-item textarea {
    padding: 0.75rem;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

.profile-detail-item input:focus,
.profile-detail-item textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}
</style>
@endsection