@extends('applicant.layout.main')
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">Detail Job</h1>
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
                    @if ($jobPosting->companyProfile->logo)
                        <img src="{{ asset('storage/' . $jobPosting->companyProfile->logo) }}" alt="{{ $jobPosting->companyProfile->company_name }}" class="logo-img">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" alt="Default Logo" class="logo-img">
                    @endif
                </div>
                <div class="company-name mt-3">
                    <h4>{{ $jobPosting->companyProfile->company_name }}</h4>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="company-header mb-4">
                    <h2 class="company-title">{{$jobPosting->position}}</h2>
                </div>

                <div class="divider mb-4"></div>

                <div class="company-content">
                    <div class="content-section mb-4">
                        <h3 class="section-title">Job Description</h3>
                        <p class="section-text">{{ $jobPosting->job_description }}</p>
                    </div>

                    <div class="content-section mb-4">
                        <h3 class="section-title">Requirements Description</h3>
                        <p class="section-text">{{ $jobPosting->requirements_desciption }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 mt-5">
                <div class="apply-button-wrapper mb-4">
                    <a href="{{route('job-posting.edit',$jobPosting->id)}}" class="btn btn-warning btn-apply w-100"><i class="icofont-edit"></i> Edit Job</a>
                </div>
                <div class="company-sidebar">
                    <div class="sidebar-item">
                        <i class="icofont-money mr-2 text-warning"></i>
                        <span>Rp. {{ $jobPosting->gaji }}</span>
                    </div>
                    <div class="sidebar-item">
                        <i class="icofont-location-pin mr-2 text-danger"></i>
                        <span>{{ $jobPosting->location->name }}</span>
                    </div>
                    <div class="sidebar-item">
                        <i class="icofont-search-job text-info"></i>
                        <span>{{ $jobPosting->fieldOfWork->name }}</span>
                    </div>
                </div>
            </div>
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

    /* Added new styles */
    .company-name {
        color: #333;
        margin-top: 1rem;
    }

    .btn-apply {
        padding: 10px 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .logo-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
</style>

@endsection