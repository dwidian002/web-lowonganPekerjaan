@extends('layoutlogin.login')
@section('login')

<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-3">Welcome!</h1>
                    <p class="text-lead text-white">Register Your Account as Company</p>
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

                    <form action="{{route('register.company.submit')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="role" value="company">
                            </div>
                            <div class="card-header text-center pt-4">
                                <h5>Complate Your Profile</h5>
                            </div>
                            <!-- -->
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="company_name" class="form-control" placeholder="Company_name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="industry" class="form-control" placeholder="Industry" required>
                                </div>
                                <div class="mb-3">
                                    <input type="year" name="tahun_berdiri" class="form-control" placeholder="Year Founded" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="alamat" class="form-control" placeholder="Location" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="description" class="form-control" placeholder="Description" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="website" class="form-control" placeholder="Website" required>
                                </div>
                                <!-- Input logo (optional) -->
                                <div class="mb-3">
                                    <label for="logo">Company Logo (Optional)</label>
                                    <input type="file" name="logo" class="form-control" accept="image/*">
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

@endsection