@extends('applicant.layout.main')
@section('content')

<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <span class="text-white">Our Company Partner</span>
            <h1 class="text-capitalize mb-5 text-lg">Company Partner</h1>
  
            <!-- <ul class="list-inline breadcumb-nav">
              <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
              <li class="list-inline-item"><span class="text-white">/</span></li>
              <li class="list-inline-item"><a href="#" class="text-white-50">Our services</a></li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
  <section class="section service-1">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            @forelse($companies as $company)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow job-card">
                        <div class="card-body">
                            <!-- Company Header -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-logo mr-3">
                                    <a href="{{ route('company.detail', $company->id) }}">
                                    @if ($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->company_name }}" 
                                             class="rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                             
                                    @else
                                        <img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" 
                                             alt="Default Logo" 
                                             class="rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <h5 class="company-name mb-0">{{ $company->company_name }}</h5>
                                </div>
                            </div>

                            <div class="job-tags mb-3">
                                <span class="badge badge-info mr-2">{{ $company->typeCompany->name }}</span>
                                <span class="badge badge-success mr-2">Founded In {{ $company->tahun_berdiri }}</span>
                            </div>

                            <div class="job-info">
                                <div class="d-flex align-items-center">
                                    <i class="icofont-industries-2 mr-2 text-warning"></i>
                                    <span> <strong>Industry :  </strong> {{ $company->industry->name }}</span>
                                </div>
                            </div>
                            <div class="job-info">
                                <div class="d-flex align-items-center">
                                    <i class="icofont-location-pin mr-2 text-danger"></i>
                                    <span> <strong>Location :  </strong> {{ $company->location->name }}</span>
                                </div>
                            </div>
                            <div class="job-info">
                                <div class="d-flex align-items-center">
                                    <i class="icofont-web mr-2 text-secondary"></i>
                                    <span><a href="{{ $company->website }}" target="_blank">{{ Str::limit($company->website, 30) }}</a></span>
                                </div>
                            </div>
    
                            {{-- <div class="text-center mt-4">
                                <a href="{{ route('company.detail', $company->id) }}" 
                                   class="btn btn-outline-primary btn-sm btn-block">
                                    View more
                                </a>
                            </div>     --}}
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
      </div>
  </section>
  <section class="section cta-page">
      <div class="container">
          <div class="row">
              <div class="col-lg-7">
                  <div class="cta-content">
                      <div class="divider mb-4"></div>
                      <h2 class="mb-5 text-lg">We are pleased to offer you the <span class="title-color">chance to have the healthy</span></h2>
                      <a href="appoinment.html" class="btn btn-main-2 btn-round-full">Get appoinment<i class="icofont-simple-right  ml-2"></i></a>
                  </div>
              </div>
          </div>
      </div>
  </section>
  
  <!-- footer Start -->
  <footer class="footer section gray-bg">
      <div class="container">
          <div class="row">
              <div class="col-lg-4 mr-auto col-sm-6">
                  <div class="widget mb-5 mb-lg-0">
                      <div class="logo mb-4">
                          <img src="layout/assets/images/logo.png" alt="" class="img-fluid">
                      </div>
                      <p>Tempora dolorem voluptatum nam vero assumenda voluptate, facilis ad eos obcaecati tenetur veritatis eveniet distinctio possimus.</p>
  
                      <ul class="list-inline footer-socials mt-4">
                          <li class="list-inline-item"><a href="https://www.facebook.com/themefisher"><i class="icofont-facebook"></i></a></li>
                          <li class="list-inline-item"><a href="https://twitter.com/themefisher"><i class="icofont-twitter"></i></a></li>
                          <li class="list-inline-item"><a href="https://www.pinterest.com/themefisher/"><i class="icofont-linkedin"></i></a></li>
                      </ul>
                  </div>
              </div>
  
              <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="widget mb-5 mb-lg-0">
                      <h4 class="text-capitalize mb-3">Department</h4>
                      <div class="divider mb-4"></div>
  
                      <ul class="list-unstyled footer-menu lh-35">
                          <li><a href="#">Surgery </a></li>
                          <li><a href="#">Wome's Health</a></li>
                          <li><a href="#">Radiology</a></li>
                          <li><a href="#">Cardioc</a></li>
                          <li><a href="#">Medicine</a></li>
                      </ul>
                  </div>
              </div>
  
              <div class="col-lg-2 col-md-6 col-sm-6">
                  <div class="widget mb-5 mb-lg-0">
                      <h4 class="text-capitalize mb-3">Support</h4>
                      <div class="divider mb-4"></div>
  
                      <ul class="list-unstyled footer-menu lh-35">
                          <li><a href="#">Terms & Conditions</a></li>
                          <li><a href="#">Privacy Policy</a></li>
                          <li><a href="#">Company Support </a></li>
                          <li><a href="#">FAQuestions</a></li>
                          <li><a href="#">Company Licence</a></li>
                      </ul>
                  </div>
              </div>
  
              <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="widget widget-contact mb-5 mb-lg-0">
                      <h4 class="text-capitalize mb-3">Get in Touch</h4>
                      <div class="divider mb-4"></div>
  
                      <div class="footer-contact-block mb-4">
                          <div class="icon d-flex align-items-center">
                              <i class="icofont-email mr-3"></i>
                              <span class="h6 mb-0">Support Available for 24/7</span>
                          </div>
                          <h4 class="mt-2"><a href="tel:+23-345-67890">Support@email.com</a></h4>
                      </div>
  
                      <div class="footer-contact-block">
                          <div class="icon d-flex align-items-center">
                              <i class="icofont-support mr-3"></i>
                              <span class="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
                          </div>
                          <h4 class="mt-2"><a href="tel:+23-345-67890">+23-456-6588</a></h4>
                      </div>
                  </div>
              </div>
          </div>
          
          <div class="footer-btm py-4 mt-5">
              <div class="row align-items-center justify-content-between">
                  <div class="col-lg-6">
                      <div class="copyright">
                          &copy; Copyright Reserved to <span class="text-color">Novena</span> by <a href="https://themefisher.com/" target="_blank">Themefisher</a>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="subscribe-form text-lg-right mt-5 mt-lg-0">
                          <form action="#" class="subscribe">
                              <input type="text" class="form-control" placeholder="Your Email address">
                              <a href="#" class="btn btn-main-2 btn-round-full">Subscribe</a>
                          </form>
                      </div>
                  </div>
              </div>
  
              <div class="row">
                  <div class="col-lg-4">
                      <a class="backtop js-scroll-trigger" href="#top">
                          <i class="icofont-long-arrow-up"></i>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </footer>

  <style>
    .job-card {
        transition: transform 0.2s ease-in-out;
        border-radius: 12px;
    }
    
    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .company-logo {
        display: flex;
        align-items: center;
    }
    
    .company-logo img {
        width: 70px !important;  
        height: 70px !important; 
        border: 1px solid #edf2f7;
        object-fit: cover;
    }
    
    .company-name {
        color: #333;
        font-size: 1.5rem !important; 
        font-weight: 600;
        line-height: 1.2;
        margin-bottom: 0;
    }
    
    .job-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
    }
    
    .job-tags .badge {
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.5em 1em;
    }
    
    .job-info {
        font-size: 0.9rem;
        color: #4a5568;
    }
    
    .job-info i {
        font-size: 1.1rem;
    }
    
    .btn-outline-primary {
        border-radius: 20px;
        padding: 0.5rem 2rem;
        border-width: 2px;
    }
    
    .pagination {
        margin-bottom: 2rem;
    }
    
    .card-body .d-flex.align-items-center.mb-3 {
        margin-bottom: 1.5rem !important;
    }
    
    .btn-outline-primary {
        border-radius: 20px;
        padding: 0.5rem 2rem;
        border-width: 2px;
        border-color: #e82454;    
        color: #e82454;
    }
    
    .btn-outline-primary:hover {
        background-color: #e82454;
        border-color: #e82454;
        color: white;            
    }
    </style>

@endsection