@extends('applicant.layout.main')

@section('content')

<section class="edit-profile-section">
    <div class="container">
        <div class="edit-profile-card">
            <div class="edit-profile-header">
                <h1>Edit Profile</h1>
                <a href="{{ route('profile-applicant') }}" class="btn btn-back">Back to Profile</a>
            </div>

            <form action="{{ route('profile-applicant.update') }}" method="POST" enctype="multipart/form-data" class="edit-profile-form">
                @csrf
                <div class="profile-avatar-upload">
                    <div class="avatar-preview">
                        <img src="{{ $applicantProfile->foto ? asset('storage/' . $applicantProfile->foto) : asset('layout/assets/images/service/default-foto.jpg') }}" 
                             alt="Profile Avatar" 
                             id="avatar-preview-img">
                    </div>
                    <div class="avatar-upload-control">
                        <label for="profile-photo" class="btn btn-upload">
                            Change Profile Photo
                            <input type="file" 
                                   id="profile-photo" 
                                   name="foto" 
                                   accept="image/*" 
                                   class="file-input">
                        </label>
                        <small>Allowed JPG, PNG. Max size 2MB</small>
                    </div>
                </div>

                <div class="profile-details-grid">
                    <div class="profile-detail-item">
                        <label for="name">Full Name</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $applicantProfile->name) }}" 
                               required>
                    </div>
                    <div class="profile-detail-item">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="Male" {{ old('gender', $applicantProfile->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $applicantProfile->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="profile-detail-item">
                        <label for="dob">Date of Birth</label>
                        <input type="date" 
                               id="dob" 
                               name="tanggal_lahir" 
                               value="{{ old('tanggal_lahir', $applicantProfile->tanggal_lahir) }}" 
                               required>
                    </div>
                    <div class="profile-detail-item">
                        <label for="phone">Phone Number</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone_number" 
                               value="{{ old('phone_number', $applicantProfile->phone_number) }}" 
                               required>
                    </div>
                    <div class="profile-detail-item full-width">
                        <label for="address">Full Address</label>
                        <textarea 
                            id="address" 
                            name="alamat_lengkap" 
                            rows="3" 
                            required>{{ old('alamat_lengkap', $applicantProfile->alamat_lengkap) }}</textarea>
                    </div>
                    <div class="profile-detail-item full-width">
                        <label for="about-me">About Me</label>
                        <textarea 
                            id="about-me" 
                            name="about_me" 
                            rows="5">{{ old('about_me', $applicantProfile->about_me) }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('profile-applicant') }}" class="btn btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
:root {
    --primary-color: #130a95;
    --secondary-color: #9b0425;
    --background-color: #f4f7f6;
    --text-color: #2c3e50;
}

.edit-profile-section {
    background: var(--background-color);
    min-height: 100vh;
    padding: 2rem 0;
    font-family: 'Arial', sans-serif;
}

.edit-profile-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.edit-profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    border-bottom: 2px solid var(--background-color);
    padding-bottom: 1rem;
}

.profile-avatar-upload {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    gap: 2rem;
}

.avatar-preview {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--primary-color);
}

.avatar-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-upload-control {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.file-input {
    display: none;
}

.btn-upload {
    background-color: var(--secondary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-upload:hover {
    background-color: var(--primary-color);
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
.profile-detail-item select,
.profile-detail-item textarea {
    padding: 0.75rem;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

.profile-detail-item input:focus,
.profile-detail-item select:focus,
.profile-detail-item textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-save {
    background-color: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    transition: background-color 0.3s ease;
}

.btn-save:hover {
    background-color: var(--secondary-color);
    color: white;
}

.btn-cancel {
    background-color: #e0e0e0;
    color: var(--text-color);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    transition: background-color 0.3s ease;
}

.btn-cancel:hover {
    background-color: #d0d0d0;
}

.btn-back {
    background-color: rgba(74, 144, 226, 0.1);
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background-color: rgba(216, 223, 231, 0.2);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('profile-photo');
    const avatarPreview = document.getElementById('avatar-preview-img');

    avatarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection