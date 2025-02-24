@extends('layoutlogin.login')
@section('login')

<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-3">Welcome!</h1>
                    <p class="text-lead text-white">Register Your Account as Applicant</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Register Here</h5>
                    </div>

                    @if(session()->has('pesan'))
                    <div class="alert alert-danger">
                        {{session()->get('pesan')}}
                    </div>
                    @endif

                    <form action="{{route('register.applicant.submit')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="role" value="applicant">
                            </div>
                            <div class="card-header text-center pt-4">
                                <h5>Complate Your Profile</h5>
                            </div>
                            <!-- -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Address</label>
                                <textarea name="alamat_lengkap" class="form-control" placeholder="Enter Your Address" ></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" placeholder="Enter Your Number" required>
                            </div>
                            <div class="mb-3">
                                <label for="about_me" class="form-label">About Me</label>
                                <textarea name="about_me" class="form-control" placeholder="About me..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profile</label>
                                <img id="fotoPreview" 
                                     src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" 
                                     alt="Foto Preview" 
                                     style="max-width: 100px; display: block; margin-bottom: 10px;">
                                <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFoto(event)">
                            </div>
                            <button type="submit" class="btn bg-gradient-danger w-100 my-4 mb-2">Register</button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{url('/login')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function previewFoto(event) {
        const fotoPreview = document.getElementById('fotoPreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                fotoPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection