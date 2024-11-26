@extends('company.layout.main')
@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
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

        <div class="search-container mb-5">
            <div class="col-12">
                <form action="{{ route('job-posting.index') }}" method="GET" class="d-flex">
                    <div class="search-wrapper">
                        <div class="search-input-container">
                            <input type="text" name="search" class="search-input" 
                                   placeholder="Search Companies" 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="select-container">
                            <select name="category" class="select-input">
                                <option value="">Semua Kategori</option>
                                @foreach($jobCategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-container">
                            <select name="lokasi" class="select-input">
                                <option value="">Semua Lokasi</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ request('lokasi') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-container">
                            <select name="field" class="select-input">
                                <option value="">Semua Bidang</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}" 
                                        {{ request('field') == $field->id ? 'selected' : '' }}>
                                        {{ $field->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-main-2 btn-icon btn-round-full">SEARCH</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($jobPostings as $jobPosting)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('job-posting.show', $jobPosting->id) }}" class="card-link-wrapper">
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
                                    <h5 class="company-name">{{ $jobPosting->companyProfile->company_name }}</h5>
                                </div>
                            </div>
        
                            <h4 class="job-title mb-3">{{ $jobPosting->position }}</h4>
        
                            <div class="job-tags mb-3">
                                <span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $jobPosting->status ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge badge-info mr-2">{{ $jobPosting->jobCategory->name }}</span>
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
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        <h4>Job Not Found</h4>
                        <p>Please try searching with other keywords or change your search filter.</p>
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
    .search-wrapper {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .search-input-container,
    .select-container {
        margin-right: 60px;
        flex-grow: 1;
    }
    
    .search-input,
    .select-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }
    
    .search-input:focus,
    .select-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    
    .btn-primary {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
    }
    
    @media (max-width: 768px) {
        .search-wrapper {
            flex-direction: column;
        }
    
        .search-input-container,
        .select-container {
            width: 100%;
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
</style>

@endsection