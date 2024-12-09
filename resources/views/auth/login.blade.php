@extends('layoutlogin.login')
@section('login')

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="login-wrapper row no-gutters">
                    <div class="col-md-6 login-image-side"></div>
                    
                    <div class="col-md-6 login-form-side">
                        <div class="login-form-header">
                            <h2>Selamat Datang</h2>
                            <p class="text-muted">Silakan login ke akun Anda</p>
                        </div>

                        @if(session()->has('pesan'))
                        <div class="alert alert-danger">
                            {{ session()->get('pesan') }}
                        </div>
                        @endif

                        <form action="{{ route('auth.verify') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" 
                                       placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group mb-4">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" 
                                       placeholder="Masukkan password" required>
                            </div>
                            
                            <button type="submit" class="btn login-btn w-100">
                                LOGIN
                            </button>
                        </form>

                        @if(session('unverified_email'))
                        <div class="text-center mt-3">
                            <p class="text-danger">Email belum terverifikasi</p>
                            <form action="{{ route('verification.resend') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('unverified_email') }}">
                                <button type="submit" class="btn btn-outline-primary">
                                    Kirim Ulang Verifikasi
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login-container {
        background: linear-gradient(45deg, #e8edf7, #355892);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-wrapper {
        background: white;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .login-image-side {
        background-image: url('assets/img/y.jpg');
        background-size: cover;
        background-position: center;
        min-height: 500px;
    }

    .login-form-side {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-btn {
        background: linear-gradient(90deg, #4e73df, #203572);
        color: white;
        border: none;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .login-btn:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateX(-100%);
        transition: transform 0.4s ease;
    }

    .login-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(50,50,93,.1), 0 3px 6px rgba(0,0,0,.08);
    }

    .login-btn:hover:before {
        transform: translateX(0);
    }

    .form-control {
        background-color: #f8f9fc;
        border: none;
        border-bottom: 2px solid #4e73df;
        transition: border-color 0.3s ease;
        padding: 10px 15px;
        position: relative;
        animation: inputFill 0.5s ease-out forwards;
        transform: translateY(20px);
        opacity: 0;
    }

    .form-control:focus {
        box-shadow: none;
        border-bottom-color: #224abe;
        background-color: #f1f3ff;
    }

    @keyframes inputFill {
        0% {
            transform: translateY(20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 992px) {
        .login-image-side {
            display: none;
        }
    }
</style>

@endsection