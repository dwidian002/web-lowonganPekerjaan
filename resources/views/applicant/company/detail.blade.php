@extends('applicant.layout.main')
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">{{$companies->company_name}}</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section company-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="company-logo">
                    @if ($companies->logo)
                        <img src="{{ asset('storage/' . $companies->logo) }}" alt="{{ $companies->company_name }}" class="logo-img">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" alt="Default Logo" class="logo-img">
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="company-header mb-4 mt-3">
                    <h2 class="company-title">{{$companies->company_name}}</h2>
                </div>

                <div class="divider mb-5"></div>

                <div class="company-content">
                    <div class="content-section mb-4">
                        <h3 class="section-title">Description</h3> 
                        <p class="section-text">{!! nl2br(e($companies->description)) !!}</p>
                    </div>

                    <div class="content-section mb-4">
                        <h3 class="section-title">Year Founded</h3>
                        <p class="section-text">{{ $companies->tahun_berdiri }}</p>
                    </div>

                    <div class="content-section">
                        <h3 class="section-title">Address</h3>
                        <p class="section-text">{{ $companies->alamat_lengkap }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 mt-5">
                <div class="company-sidebar">
                    <div class="sidebar-item">
                        <i class="icofont-industries-2 mr-2 text-warning"></i>
                        <span>{{ $companies->industry->name }}</span>
                    </div>
                    <div class="sidebar-item">
                        <i class="icofont-location-pin mr-2 text-danger"></i>
                        <span>{{ $companies->location->name }}</span>
                    </div>
                    <div class="sidebar-item">
                        <i class="icofont-web mr-2 text-info"></i>
                        <a href="{{ $companies->website }}" target="_blank">{{ $companies->website }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section job-postings">
    <div class="container">
        <div class="row">
            <div class="col-12">
				<h3>Job Posted</h3>
				<div class="divider my-4 mb-4"></div>
            </div>
        </div>
        <div class="row">
            @forelse($companies->jobPostings as $jobPosting)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('job-detail', $jobPosting->id) }}" class="card-link-wrapper">
                    <div class="card h-100 shadow job-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-logo mr-3">
                                    @if ($jobPosting->companyProfile && $jobPosting->companyProfile->logo)
                                        <img src="{{ asset('storage/' . $jobPosting->companyProfile->logo) }}"
                                             alt="{{ $jobPosting->companyProfile->company_name }}"
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
                                    <h5>{{ $jobPosting->companyProfile->company_name }}</h5>
                                </div>
                            </div>
        
                            <h4 class="job-title mb-3 position">{{ $jobPosting->position }}</h4>

                            <div class="job-tags mb-3">
                                <span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $jobPosting->status ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge badge-info mr-2">{{ $jobPosting->jobCategory->category_name }}</span>
                                <span class="badge badge-primary mr-2">{{ $jobPosting->fieldOfWork->name }}</span>
                            </div>
        
                            <div class="job-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="icofont-money mr-2 text-warning"></i>
                                    @if($jobPosting->sembunyikan_gaji)
                                        <span class="font-italic text-muted">(disembunyikan)</span>
                                    @else
                                        <span>Rp {{ number_format($jobPosting->gaji, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="icofont-location-pin mr-2 text-danger"></i>
                                    <span>{{ $jobPosting->location->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            @endforelse
        </div>


    </div>
</section>

<style>
    .company-sidebar {
        background-color: #ebf1f4;  
        border-radius: 8px;         
        padding: 20px;              
    }

    .sidebar-item {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .sidebar-item:last-child {
        margin-bottom: 0;
    }

    .sidebar-item i {
        margin-right: 10px;        
    }

    .sidebar-item a {
        color: inherit;            
        text-decoration: none;     
    }

    .sidebar-item a:hover {
        text-decoration: underline; 
    }
</style>

@endsection

