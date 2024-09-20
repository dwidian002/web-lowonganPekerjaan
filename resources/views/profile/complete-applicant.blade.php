@extends('layoutlogin.login')

@section('login')
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('image-path'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-3">Complete Your Applicant Profile</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Applicant Profile</h5>
                    </div>
                    <form action="{{url('/profile/complete-applicant/{token}', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="ttl" class="form-control" placeholder="TTL" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone_number" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="education" class="form-control" placeholder="Education" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="experience" class="form-control" placeholder="Experience" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="skills" class="form-control" placeholder="Skills" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="resume" class="form-control" placeholder="Resume" required>
                            </div>
                            <button type="submit" value="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Complete Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
