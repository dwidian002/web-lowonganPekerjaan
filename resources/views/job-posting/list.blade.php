@extends('layoutcompany.main')
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
                            <!-- Company Header -->
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
                                    <h5 class="company-name mb-0">{{ $jobPosting->companyProfile->company_name }}</h5>
                                </div>
                            </div>

                            <!-- Position Title -->
                            <h4 class="job-title mb-3">{{ $jobPosting->position }}</h4>

                            <!-- Tags -->
                            <div class="job-tags mb-3">
                                <span class="badge badge-info mr-2">{{ $jobPosting->jobCategory->category_name }}</span>
                                <span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $jobPosting->status ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge badge-primary mr-2">{{ $jobPosting->fieldOfWork->name }}</span>
                            </div>

                            <!-- Salary and Location -->
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

                            <!-- View More Button -->
                            <div class="text-center mt-4">
                                <a href="{{ route('job-posting.show', $jobPosting->id) }}" 
                                   class="btn btn-outline-primary btn-sm btn-block">
                                    View more
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <h4>No Job Postings Available</h4>
                        <p>Start by creating your first job posting!</p>
                        <a href="{{ route('job-posting.add') }}" class="btn btn-main-2 btn-round-full mt-3">
                            Create Job Posting <i class="icofont-plus"></i>
                        </a>
                    </div>
                </div>
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