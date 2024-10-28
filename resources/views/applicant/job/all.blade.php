@extends('applicant.layout.main')
@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <span class="text-white">Our services</span>
                    <h1 class="text-capitalize mb-5 text-lg">All Jobs</h1>

                    <div class="search-container">
                        <div class="btn-container mb-0">
                            <a href="{{ route('job-posting.add') }}" class="btn btn-main-2 btn-icon btn-round-full">
                                Create New Job Posting <i class="icofont-plus"></i>
                            </a>
                        </div>
                    </div>
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
            @forelse($jobPostings as $jobPosting)
            <div class="col-lg-4 col-md-6 mb-4">
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
                            <a href="{{ route('company.detail', $jobPosting->companyProfile->id) }}" class="company-name-link">
                                <h5 class="company-name">{{ $jobPosting->companyProfile->company_name }}</h5>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('job-posting.show', $jobPosting->id) }}" class="job-details-link">
                        <div class="job-content">
                            <h4 class="job-title mb-3">{{ $jobPosting->position }}</h4>

                            <div class="job-tags mb-3">
                                <span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $jobPosting->status ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge badge-info mr-2">{{ $jobPosting->jobCategory->category_name }}</span>
                                <span class="badge badge-primary mr-2">{{ $jobPosting->fieldOfWork->name }}</span>
                            </div>

                            <div class="job-info">
                                @unless($jobPosting->sembunyikan_gaji)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="icofont-money mr-2 text-warning"></i>
                                        <span>Rp {{ number_format($jobPosting->gaji, 0, ',', '.') }}</span>
                                    </div>
                                @endunless
                                <div class="d-flex align-items-center">
                                    <i class="icofont-location-pin mr-2 text-danger"></i>
                                    <span>{{ $jobPosting->location->name }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>

        @if($jobPostings->count() > 0)
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $jobPostings->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

@endsection