@extends('layoutcompany.main')
@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <span class="text-white">Our services</span>
            <h1 class="text-capitalize mb-0 text-lg">All Jobs</h1>
  
            {{-- <!-- <ul class="list-inline breadcumb-nav">
              <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
              <li class="list-inline-item"><span class="text-white">/</span></li>
              <li class="list-inline-item"><a href="#" class="text-white-50">Our services</a></li>
            </ul> --> --}}

            <div class="search-container">
                <div class="sidebar-widget search  mb-0">
                    <form action="#" method="GET">
                        <div class="search-wrapper">
                            <div class="search-input-container">
                                <input type="text" name="search" class="search-input" placeholder="Search">
                            </div>
                            <div class="select-container">
                                <select name="kategori" class="select-input">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-container">
                                <select name="lokasi" class="select-input">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-container">
                                <select name="bidang" class="select-input">
                                    <option value="">Pilih Bidang</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field->id }}">{{ $field->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-main-2 btn-icon btn-round-full">SEARCH</button>
                        </div>
                    </form>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    
  </section>
  
  <section class="section service-1">
      <div class="container">
          <div class="row">
            <div class="container mt-0">
                <!-- Job Listing -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="feature-block d-lg-flex">
                            <div class="feature-item mb-5 mb-lg-0">
                                <div class="feature-icon mb-4">
                                    <h3>
                                    <i class="icofont-search-job text-danger"></i>
                                    CompanyName
                                    </h3>
                                </div>
                                <span class="badge badge-info">category</span> 
                                <span class="badge badge-info">bidang</span> 
                                <span class="badge badge-success">status</span>
                                
                                <h4 class="mb-0">Posisi</h4>
                                <div class="mt-1">
                                    <i class="icofont-money text-warning"></i> gaji
                                </div>
                                    <div>
                                    <i class="icofont-location-pin text-danger"></i> location
                                </div>
                                <p class="mb-4">description</p>
                                <a href="appoinment.html" class="btn btn-main btn-round-full">Apply</a>
                            </div>
                        
                            <div class="feature-item mb-5 mb-lg-0">
                                <div class="feature-icon mb-4">
                                    <h3>
                                        <img src="{{ asset('path-to-company-logo.jpg') }}" alt="Company Logo" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                    CompanyName
                                    </h3>
                                </div>
                                <span class="badge badge-info">category</span> <span class="badge badge-success">status</span>
                                <h4 class="mb-0">Posisi</h4>
                                <div class="mt-1">
                                    <i class="icofont-money text-warning"></i> gaji
                                </div>
                                    <div>
                                    <i class="icofont-location-pin text-danger"></i> location
                                </div>
                                <p class="mb-4">description</p>
                                
                                <a href="#" class="btn btn-primary custom-btn-sm">
                                    View Detail
                                </a>
                            </div>
                        
                            <div class="feature-item mb-5 mb-lg-0">
                                <div class="feature-icon mb-4">
                                    <h3>
                                    <i class="icofont-search-job text-danger"></i>
                                    CompanyName
                                    </h3>
                                </div>
                                <span class="badge badge-info">category</span> <span class="badge badge-success">status</span>
                                <h4 class="mb-0">Posisi</h4>
                                <div class="mt-1">
                                    <i class="icofont-money text-warning"></i> gaji
                                </div>
                                    <div>
                                    <i class="icofont-location-pin text-danger"></i> location
                                </div>
                                <p class="mb-4">description</p>
                                <a href="appoinment.html" class="btn btn-main btn-round-full">Apply</a>
                            </div>
                        </div>
                    </div>
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
                          <img src="images/logo.png" alt="" class="img-fluid">
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
    .custom-btn-sm {
        padding: 2px 10px; /* Padding lebih kecil */
        font-size: 12px; /* Ukuran font lebih kecil */
    }

    .search-container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto; /* Center horizontally */
    display: flex;
    justify-content: center; /* Center the content inside the container */
    padding: 20px 0; /* Optional: add some vertical space */
}

.input-group {
    display: flex;
    border-radius: 50px;
    overflow: hidden;
    width: 100%;
}

.search-icon {
    background-color: #f1f1f1;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
}

.form-control {
    border: none;
    box-shadow: none;
    padding-left: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    width: 100%;
}

.custom-select {
    border: none;
    border-left: 1px solid #ddd;
    background-color: #f1f1f1;
    border-top-right-radius: 50px;
    border-bottom-right-radius: 50px;
    padding: 10px;
}

.custom-select:focus {
    box-shadow: none;
}

.input-group .form-control:focus {
    box-shadow: none;
}

</style>


@endsection