@extends('layoutlogin.login')
@section('login')

<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-3">Welcome Back!</h1>
                    <p class="text-lead text-white">Please Login</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Login Here</h5>
                    </div>

                    @if(session()->has('pesan'))
                    <div class="alert alert-danger">
                        {{session()->get('pesan')}}
                    </div>
                    @endif

                    <form action="{{route('auth.verify')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                    placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Password">
                            </div>
                            <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">LOGIN</button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{url('/register')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>

    @if(session('unverified_email'))
        <div class="mt-4">
            <p class="text-sm text-red-600">Email belum terverifikasi</p>
            <form action="{{ route('verification.resend') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="email" value="{{ session('unverified_email') }}">
                <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-500">
                    Kirim ulang email verifikasi
                </button>
            </form>
        </div>
    @endif
</main>

@endsection