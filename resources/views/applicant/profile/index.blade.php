@extends('applicant.layout.main')

@section('content')

<section class="section profile-section mt-n5 pb-5" style="background-color: #f7fafc;">
    <div class="container">
        <div class="d-flex align-items-center mb-5">
            <div class="profile-image-container me-5">
                @if ($applicantProfile && $applicantProfile->foto)
                    <img src="{{ asset('storage/' . $applicantProfile->foto) }}" alt="{{ $applicantProfile->name }}" class="profile-image rounded-circle" style="width: 150px; height: 150px;">
                @else
                    <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" alt="Default Foto" class="profile-image rounded-circle" style="width: 150px; height: 150px;">
                @endif
            </div>
            <div class="d-flex flex-column justify-content-center flex-grow-1">
                <div class="mb-3">
                    <h2>{{ $applicantProfile->name ?? '' }}</h2>
                </div>
                <div>
                    <p>{{ $applicantProfile->user->email ?? '' }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="profile-image-container me-4">
                                <h2>My Profile</h2>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <a href="{{ route('logout') }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ $applicantProfile->name ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" class="form-control" id="gender" value="{{ $applicantProfile->gender ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" class="form-control" id="dob" value="{{ $applicantProfile->tanggal_lahir ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" value="{{ $applicantProfile->phone_number ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" value="{{ $applicantProfile->alamat_lengkap ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about-me">About Me</label>
                                    <textarea class="form-control" id="about-me" rows="3" readonly>{{ $applicantProfile->about_me ?? '-' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .profile-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    }

    .photo-container {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    }

    .photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }

    .logout-button {
    background-color: #e74c3c;
    color: #fff;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    }

    .profile-info .field {
    margin-bottom: 20px;
    }

    .profile-info label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    }

    .profile-info input,
    .profile-info textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    }

    .about-me {
    margin-top: 20px;
    }

    .about-me textarea {
    height: 100px;
    }
</style>
@endsection