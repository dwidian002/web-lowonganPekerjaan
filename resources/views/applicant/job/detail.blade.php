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
                    @if ($jobPosting->status)
                        @if(Auth::check() && Auth::user()->role === 'applicant')
                            @php
                                $profile = \App\Models\ApplicantProfile::where('user_id', Auth::id())->first();
                                $isProfileComplete = false;
                                
                                if ($profile) {
                                    $skills = \App\Models\Skill::where('applicant_profile_id', $profile->id)->count();
                                    $education = \App\Models\Education::where('applicant_profile_id', $profile->id)->count();
                                    $experience = \App\Models\Experience::where('applicant_profile_id', $profile->id)->count();
                                    
                                    $isProfileComplete = ($skills > 0 && $education > 0 && $experience > 0);
                                }
                            @endphp

                            @if($isProfileComplete)
                                <a href="{{route('form.apply', $jobPosting->id)}}" class="btn btn-info btn-round-full w-100 btn-apply">Apply</a>
                            @else
                                <button type="button" class="btn btn-info btn-round-full w-100 btn-apply" data-toggle="modal" data-target="#incompleteProfileModal">
                                    Apply
                                </button>
                            @endif
                        @else
                            <a href="{{route('form.apply', $jobPosting->id)}}" class="btn btn-info btn-round-full w-100 btn-apply">Apply</a>
                        @endif
                    @else
                        <button type="button" class="btn btn-info btn-round-full w-100 btn-apply disabled-button" disabled>Apply</button>
                    @endif
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

<div class="modal fade" id="incompleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="incompleteProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="incompleteProfileModalLabel">Profile Tidak Lengkap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                    $message = 'Profile belum dibuat, silakan lengkapi profile anda';
                    if ($profile) {
                        $message = 'Profile anda belum lengkap, lengkapi sekarang';
                    }
                @endphp
                <p>{{ $message }}</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('profile-more-info') }}" class="btn btn-primary">Lengkapi Sekarang</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nanti Saja</button>
            </div>
        </div>
    </div>
</div>

<style>
    .disabled-button {
        background-color: #ccc;
        border-color: #ccc;
        color: #666;
        cursor: not-allowed;
    }

    .disabled-button:hover {
        transform: none;
        box-shadow: none;
    }

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

    .company-name {
        color: #333;
        margin-top: 1rem;
    }

    .btn-apply {
        background-color: #18bbca !important;
        color: #fff !important;
        font-size: 1rem;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-apply:hover {
        background-color: #0a7782 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-apply:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .logo-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Modal styles */
    .modal-content {
        border-radius: 8px;
    }

    .modal-header {
        border-bottom: 1px solid #eee;
        background-color: #f8f9fa;
        border-radius: 8px 8px 0 0;
    }

    .modal-footer {
        border-top: 1px solid #eee;
        background-color: #f8f9fa;
        border-radius: 0 0 8px 8px;
    }
</style>

@endsection