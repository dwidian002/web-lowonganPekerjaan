@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow-lg border-primary mb-4">
                <div class="card-header bg-gradient-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h3 class="m-0 font-weight-bold">
                        <i class="fas fa-briefcase mr-2"></i>{{ $jobPosting->position }}
                    </h3>
                    <div class="d-flex align-items-center">
                        <span class="badge 
                            {{ $jobPosting->status == 'active' ? 'badge-success' : 
                               ($jobPosting->status == 'closed' ? 'badge-danger' : 'badge-warning') }} mr-2">
                            {{ ucfirst($jobPosting->status) }}
                        </span>
                        <a href="{{ route('job.delete', $jobPosting->id) }}" 
                            onclick="return confirm('Are you sure you want to delete this job posting?')" 
                            class="btn btn-danger btn-sm">
                             <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3"><i class="fas fa-info-circle mr-2"></i>Job Details</h5>
                                    <p class="mb-2"><strong>Company:</strong> {{ $jobPosting->companyProfile->company_name }}</p>
                                    <p class="mb-2"><strong>Location:</strong> {{ $jobPosting->location->name }}</p>
                                    <p class="mb-2"><strong>Field of Work:</strong> {{ $jobPosting->fieldOfWork->name }}</p>
                                    <p class="mb-2"><strong>Job Category:</strong> {{ $jobPosting->jobCategory->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-left-success shadow h-100 py-2 mb-4">
                                <div class="card-body">
                                    <h5 class="text-success mb-3"><i class="fas fa-dollar-sign mr-2"></i>Compensation</h5>
                                    @if(!$jobPosting->sembunyikan_gaji)
                                        <p class="mb-2">
                                            <strong>Salary:</strong> 
                                            {{ $jobPosting->gaji ? 'Rp ' . number_format($jobPosting->gaji, 0, ',', '.') : 'Not specified' }}
                                        </p>
                                    @else
                                        <p class="mb-2"><strong>Salary:</strong> Confidential</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-info mb-4">
                <div class="card-header bg-gradient-info text-white py-3">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-file-alt mr-2"></i>Job Description
                    </h5>
                </div>
                <div class="card-body">
                    <div class="rich-text-content">
                        {!! nl2br(e($jobPosting->job_description)) !!}
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-warning mb-4">
                <div class="card-header bg-gradient-warning text-white py-3">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-list-ul mr-2"></i>Requirements
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
@endsection

<style>
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
</style>