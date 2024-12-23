@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-white mb-3 mt-0">
                    Detail Application: {{ $application->applicantProfile->name }}
                </h3>
                <a href="{{ route('application.list') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    @if (session()->has('pesan'))
    <div class="alert alert-{{session()->get('pesan')[0]}}">
        {{session()->get('pesan')[1]}}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg mb-4 border-left-primary">
                <div class="card-header py-1 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Applicant Profile</h6>
                </div>
                <div class="card-body text-center">
                    @if($application->applicantProfile->foto)
                        <img src="{{ asset('storage/' . $application->applicantProfile->foto) }}" 
                             alt="Applicant Photo" 
                             class="img-fluid rounded-circle mb-3" 
                             style="max-width: 150px;">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" 
                             alt="Default Photo" 
                             class="img-fluid rounded-circle mb-3" 
                             style="max-width: 150px;">
                    @endif
                    <h4 class="card-title mb-0">{{ $application->applicantProfile->name }}</h4>

                    <div class="mb-3">
                        @if ($application->application_status == 'applied')
                            <span class="badge bg-dark text-white">
                                {{ ucfirst($application->application_status) }}
                            </span>
                        @elseif ($application->application_status == 'in_review')
                            <span class="badge bg-info text-white">
                                {{ ucfirst($application->application_status) }}
                            </span>
                        @elseif ($application->application_status == 'interview')
                            <span class="badge bg-warning text-dark">
                                {{ ucfirst($application->application_status) }}
                            </span>
                        @elseif ($application->application_status == 'hired')
                            <span class="badge bg-success text-white">
                                {{ ucfirst($application->application_status) }}
                            </span>
                        @elseif ($application->application_status == 'rejected')
                            <span class="badge bg-danger text-white">
                                {{ ucfirst($application->application_status) }}
                            </span>
                        @endif
                    </div>

                    <div class="mb-2">
                        @if($application->resume)
                            <a href="{{ asset('storage/' . $application->resume) }}" class="btn btn-info btn-sm" target="_blank">
                                <i class="fas fa-file-pdf"></i> View Resume
                            </a>
                        @endif
                        @if($application->portofolio)
                            <a href="{{ $application->portofolio }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="fas fa-folder"></i> View Portfolio
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card shadow-lg mb-4 border-left-success">
                <div class="card-header py-1 bg-gradient-success text-white">
                    <h6 class="m-0 font-weight-bold">Personal Information</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="far fa-calendar-alt mr-2"></i> {{ $application->applicantProfile->tanggal_lahir }}
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-venus-mars mr-2"></i> {{ $application->applicantProfile->gender }}
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone mr-2"></i> {{ $application->applicantProfile->phone_number }}
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt mr-2"></i> {{ $application->applicantProfile->alamat_lengkap }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-lg mb-4 border-left-primary">
                <div class="card-header py-1 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Work Experience</h6>
                </div>
                <div class="card-body">
                    @forelse($application->applicantProfile->experiences as $experience)
                        <div class="mb-4">
                            <h5 class="font-weight-bold">{{ $experience->job_Title }}</h5>
                            <p class="mb-1"><strong>{{ $experience->company_name }}</strong></p>
                            <p class="text-muted mb-2">{{ $experience->lama_bekerja }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No work experiences available.</p>
                    @endforelse
                </div>
            </div>

            <div class="card shadow-lg mb-4 border-left-success">
                <div class="card-header py-1 bg-gradient-success text-white">
                    <h6 class="m-0 font-weight-bold">Education</h6>
                </div>
                <div class="card-body">
                    @forelse($application->applicantProfile->educations as $education)
                        <div class="mb-4">
                            <h5 class="font-weight-bold">{{ $education->degree }}</h5>
                            <p class="mb-1"><strong>{{ $education->institution_name }}</strong></p>
                            <p class="text-muted">{{ $education->starting_year }} - {{ $education->finishing_year }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No education history available.</p>
                    @endforelse
                </div>
            </div>

            <div class="card shadow-lg mb-4 border-left-warning">
                <div class="card-header py-1 bg-gradient-warning text-white">
                    <h6 class="m-0 font-weight-bold">Skills</h6>
                </div>
                <div class="card-body">
                    @forelse($application->applicantProfile->skills as $skill)
                        <span class="badge bg-primary text-white rounded-pill px-3 py-2 me-2 mb-2 d-inline-block" 
                              style="font-size: 0.9rem;">
                            {{ $skill->name }}
                        </span>
                    @empty
                        <p class="text-muted">No skills listed.</p>
                    @endforelse
                </div>
            </div>

            @if($application->applicantProfile->about_me)
            <div class="card shadow-lg mb-4 border-left-info">
                <div class="card-header py-1 bg-gradient-info text-white">
                    <h6 class="m-0 font-weight-bold">About</h6>
                </div>
                <div class="card-body">
                    <p>{!! nl2br(e($application->applicantProfile->about_me)) !!}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    
    <div class="card shadow-lg mb-4 border-left-info">
        <div class="card-header py-1 bg-gradient-info text-white">
            <h6 class="m-0 font-weight-bold">Job Information</h6>
        </div>
        <div class="card-body">
            <h5 class="font-weight-bold">{{ $application->jobPosting->position }}</h5>
            <p class="mb-2"><strong>{{ $application->jobPosting->companyProfile->company_name }}</strong></p>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <i class="fas fa-briefcase mr-2"></i> {{ $application->jobPosting->jobCategory->name ?? 'N/A' }}
                </li>
                <li class="mb-2">
                    <i class="fas fa-map-marker-alt mr-2"></i> {{ $application->jobPosting->location->name ?? 'N/A' }}
                </li>
                <li class="mb-2">
                    <i class="fas fa-layer-group mr-2"></i> {{ $application->jobPosting->fieldOfWork->name ?? 'N/A' }}
                </li>
                @if(!$application->jobPosting->sembunyikan_gaji)
                <li>
                    <i class="fas fa-money-bill mr-2"></i> {{ $application->jobPosting->gaji }}
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection