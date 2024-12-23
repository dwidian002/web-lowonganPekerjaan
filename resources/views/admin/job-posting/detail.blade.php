@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="font-weight-bolder text-white m-0">
                    Job Posting from: {{ $jobPosting->companyProfile->company_name }}
                </h3>
                
                <a href="{{route('job.delete', $jobPosting->id)}}"
                   onclick="return confirm('Are you sure you want to delete this job posting?')"
                   class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i> Delete
                </a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow-lg border-primary mb-4">
                <div class="card-header bg-gradient-primary text-white py-1 d-flex justify-content-between align-items-center">
                    <h3 class="m-0 font-weight-bold">
                        <i class="fas fa-briefcase mr-2"></i> {{ $jobPosting->position }}
                    </h3>
                    <div class="d-flex align-items-center">
                        <span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-danger' }} mr-2">
                            {{ $jobPosting->status ? 'Active' : 'Closed' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-info-circle mr-2"></i> Job Details
                                    </h5>
                                    <div class="mb-2"><strong>Company:</strong> {{ $jobPosting->companyProfile->company_name }}</div>
                                    <div class="mb-2"><strong>Location:</strong> {{ $jobPosting->location->name }}</div>
                                    <div class="mb-2"><strong>Field of Work:</strong> {{ $jobPosting->fieldOfWork->name }}</div>
                                    <div class="mb-0"><strong>Job Category:</strong> {{ $jobPosting->jobCategory->name }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-left-success shadow h-100 py-2 mb-4">
                                <div class="card-body">
                                    <h5 class="text-success mb-3">
                                        <i class="fas fa-dollar-sign mr-2"></i> Compensation
                                    </h5>
                                    @if(!$jobPosting->sembunyikan_gaji)
                                        <div class="mb-0">
                                            <strong>Salary:</strong> 
                                            {{ $jobPosting->gaji ? 'Rp ' . number_format($jobPosting->gaji, 0, ',', '.') : 'Not specified' }}
                                        </div>
                                    @else
                                        <div class="mb-0"><strong>Salary:</strong> Confidential</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-info mb-4">
                <div class="card-header bg-gradient-info text-white py-1">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-file-alt mr-2"></i> Job Description
                    </h5>
                </div>
                <div class="card-body">
                    <div class="rich-text-content">
                        {!! nl2br(e($jobPosting->job_description)) !!}
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-warning mb-4">
                <div class="card-header bg-gradient-warning text-white py-1">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-list-ul mr-2"></i> Requirements
                    </h5>
                </div>
                <div class="card-body">
                    <div class="rich-text-content">
                        {!! nl2br(e($jobPosting->requirements_desciption)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge-success {
    background-color: #28a745;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

.badge-danger {
    background-color: #dc3545;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

.rich-text-content {
    line-height: 1.6;
    color: #333;
    max-width: 100%;
    word-wrap: break-word;
}

.bg-gradient-primary {
    background: linear-gradient(to right, #4e73df 0%, #224abe 100%);
}

.bg-gradient-info {
    background: linear-gradient(to right, #36b9cc 0%, #258391 100%);
}

.bg-gradient-warning {
    background: linear-gradient(to right, #f6c23e 0%, #dda20a 100%);
}

.card-body div:last-child {
    margin-bottom: 0;
}
</style>
@endsection