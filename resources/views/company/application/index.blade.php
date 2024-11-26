@extends('company.layout.main')
@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">All Application</h1>
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
                <form action="{{ route('application.index') }}" method="GET" class="d-flex">
                    <div class="search-wrapper">
                        <div class="search-input-container">
                            <input type="text" 
                                   name="search" 
                                   class="search-input"
                                   placeholder="Cari nama atau email"
                                   value="{{ request('search') }}"
                                   maxlength="100">
                        </div>
                        
                        <div class="select-container">
                            <select name="status" class="select-input">
                                <option value="">Semua Status</option>
                                <option value="applied" 
                                        {{ request('status') == 'applied' ? 'selected' : '' }}>
                                    Applied
                                </option>
                                <option value="in_review" 
                                        {{ request('status') == 'in_review' ? 'selected' : '' }}>
                                    In Review
                                </option>
                                <option value="interview" 
                                        {{ request('status') == 'interview' ? 'selected' : '' }}>
                                    Interview
                                </option>
                                <option value="hired" 
                                        {{ request('status') == 'hired' ? 'selected' : '' }}>
                                    Hired
                                </option>
                                <option value="rejected" 
                                        {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                    Rejected
                                </option>
                            </select>
                        </div>
                        
                        <div class="select-container">
                            <select name="job_posting" class="select-input">
                                <option value="">Semua Posisi</option>
                                @foreach($jobPostings as $posting)
                                    <option value="{{ $posting->id }}"
                                            {{ request('job_posting') == $posting->id ? 'selected' : '' }}>
                                        {{ $posting->position }} - {{ $posting->companyProfile->company_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-main-2 btn-icon btn-round-full">
                            SEARCH
                        </button>
                    </div>
                </form>
            </div>
        </div>
        

            <div class="row">
                @forelse($applications as $application)
                <div class="col-lg-4 col-md-6 mb-4">
                    @if ($application->application_status == 'applied')
                    <a href="#" data-toggle="modal" data-target="#confirmModal-{{ $application->id }}" 
                    data-application="{{ $application->user->applicantProfile->name }}">
                    @else
                        <a href="{{ route('company.application.detail', $application->id) }}">
                    @endif
                        <div class="card h-100 shadow job-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="company-foto mr-3">
                                        @if ($application->user->applicantProfile && $application->user->applicantProfile->foto)
                                            <img src="{{ asset('storage/' . $application->user->applicantProfile->foto) }}"
                                                alt="{{ $application->user->applicantProfile->name }}"
                                                class="rounded"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}"
                                                alt="Default foto"
                                                class="rounded"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="job-title mb-3 position">{{ $application->user->applicantProfile->name }}</h2> 
                                        </div>
                                </div>
            
                                <div class="job-info">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="{{ route('job-posting.show', $application->jobPosting->id) }}" class="company-name-link">
                                            <i class="icofont-search-job text-primary"></i>
                                            <span class="ml-2">Applied for:  {{ $application->jobPosting->position }}</span>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="icofont-calendar text-primary"></i>
                                        <span class="ml-2">Applied at: {{ $application->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer px-4 py-3 d-flex justify-content-between align-items-center
                                @if ($application->application_status == 'applied')
                                    bg-dark text-white
                                @elseif ($application->application_status == 'in_review')
                                    bg-info text-white
                                @elseif ($application->application_status == 'interview')
                                    bg-warning text-dark
                                @elseif ($application->application_status == 'hired')
                                    bg-success text-white
                                @elseif ($application->application_status == 'rejected')
                                    bg-danger text-white
                                @else
                                    bg-white border-top
                                @endif">
                                <span class="text-sm">{{ strtoupper($application->application_status) }}</span>
                                <span class="text-sm">{{ $application->updated_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            <h4>Application Not Found</h4>
                            <p>Please try searching with other keywords or change your search filter.</p>
                        </div>
                    </div>
                @endforelse  
            </div>

                @if($applications->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $applications->links() }}
                        </div>
                    </div>
                @endif
        </div>
        @foreach($applications as $application)
            @if ($application->application_status == 'applied')
            <div class="modal fade" id="confirmModal-{{ $application->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Confirm Application Review
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to review the application for 
                            {{ $application->user->applicantProfile->name }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <a href="{{ route('company.application.detail', $application->id) }}?confirmed" 
                            class="btn btn-primary">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
</section>

<script>
    $('#confirmModal').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget);
        $('#confirmModal .btn-primary').attr('href', link.attr('href'));
    });
</script>

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