@extends('applicant.layout.main')

@section('content')
<div class="profile-container">
    <div class="profile-wrapper">
        @include('applicant.profile.sidebar', ['applicantProfile' => $applicantProfile])

        <main class="profile-content">
            <section id="personal-info" class="profile-section">
                <div class="section-header">
                    <h2>Personal Information</h2>
                    <a href="{{ route('profile-applicant.edit', $applicantProfile->id) }}" class="btn-edit-profile">
                        <i class="icofont-edit"></i> Edit
                    </a>
                </div>
                
                <div class="info-grid">
                    <div class="info-card">
                        <label>Full Name</label>
                        <div class="info-value">{{ $applicantProfile->name ?? '-' }}</div>
                    </div>
                    <div class="info-card">
                        <label>Gender</label>
                        <div class="info-value">{{ $applicantProfile->gender ?? '-' }}</div>
                    </div>
                    <div class="info-card">
                        <label>Date of Birth</label>
                        <div class="info-value">{{ $applicantProfile->tanggal_lahir ?? '-' }}</div>
                    </div>
                    <div class="info-card">
                        <label>Phone Number</label>
                        <div class="info-value">{{ $applicantProfile->phone_number ?? '-' }}</div>
                    </div>
                    <div class="info-card full-width">
                        <label>Address</label>
                        <div class="info-value">{{ $applicantProfile->alamat_lengkap ?? '-' }}</div>
                    </div>
                    <div class="info-card full-width">
                        <label>About Me</label>
                        <div class="info-value">{{ $applicantProfile->about_me ?? '-' }}</div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

@endsection