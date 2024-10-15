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
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
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
                                    <label for="name" class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Industry</label>
                                    <input type="text" name="industry" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Year Founded</label>
                                    <input type="year" name="tahun_berdiri" class="form-control" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Location</label>
                                    <select name="location" class="form-control" required>
                                        <option value="">Select Location</option>
                                        @foreach($location as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_lengkap" class="form-label">Address</label>
                                    <textarea name="alamat_lengkap" class="form-control" rows="3" placeholder="" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">website</label>
                                    <input type="text" name="website" class="form-control" placeholder="Website" required>
                                </div>
                                <!-- Input logo (optional) -->
                                <div class="mb-3">
                                    <label for="logo">Company Logo (Optional)</label>
                                    <input type="file" name="logo" class="form-control" accept="image/*">
                                </div>
                                <button type="submit" class="btn bg-gradient-danger w-100 my-4 mb-2">Register</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{route('auth.index')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection