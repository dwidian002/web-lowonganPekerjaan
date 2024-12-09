@extends('applicant.layout.main')

@section('content')
<div class="profile-container">
    <div class="profile-wrapper">
        @include('applicant.profile.sidebar', ['applicantProfile' => $applicantProfile])

        <div class="profile-content-container">
            <main class="profile-content">
                @if(session('pesan'))
                    <div class="alert alert-{{ session('pesan')[0] }} shadow-sm">
                        <div class="alert-icon">
                            @if(session('pesan')[0] == 'success')
                                <i class="icofont-check-circled text-success"></i>
                            @else
                                <i class="icofont-warning text-danger"></i>
                            @endif
                        </div>
                        <div class="alert-content">
                            <strong>{{ session('pesan')[0] == 'success' ? 'Success!' : 'Error!' }}</strong>
                            {{ session('pesan')[1] }}
                        </div>
                    </div>
                @endif

                <section id="my-applications" class="profile-section">
                    <div class="section-header">
                        <h2 class="section-title">My Applications</h2>
                    </div>

                    @if($applications->isEmpty())
                        <div class="no-application-message">
                            <i class="icofont-paper display-4 text-muted"></i>
                            <p class="text-muted">You haven't applied to any jobs yet</p>
                        </div>
                    @else
                        <div class="applications-grid">
                            @foreach($applications as $application)
                                <div class="application-card 
                                    @if ($application->application_status == 'applied') border-primary 
                                    @elseif ($application->application_status == 'in_review') border-info
                                    @elseif ($application->application_status == 'interview') border-warning
                                    @elseif ($application->application_status == 'hired') border-success
                                    @elseif ($application->application_status == 'rejected') border-danger
                                    @else border-secondary
                                    @endif">
                                    <div class="application-card-header">
                                        <h3 class="job-title">{{ $application->jobPosting->position }}</h3>
                                        <span class="applied-date text-muted">
                                            <i class="icofont-calendar me-1"></i>
                                            {{ $application->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="application-card-body">
                                        <div class="company-info">
                                            <i class="icofont-building me-2"></i>
                                            {{ $application->jobPosting->companyProfile->company_name }}
                                        </div>
                                        <div class="job-location">
                                            <i class="icofont-location-pin me-2"></i>
                                            {{ $application->jobPosting->location->name }}
                                        </div>
                                    </div>

                                    <div class="application-card-footer">
                                        <div class="status-badge 
                                            @if ($application->application_status == 'applied') bg-primary
                                            @elseif ($application->application_status == 'in_review') bg-info
                                            @elseif ($application->application_status == 'interview') bg-warning
                                            @elseif ($application->application_status == 'hired') bg-success
                                            @elseif ($application->application_status == 'rejected') bg-danger
                                            @else bg-secondary
                                            @endif">
                                            {{ strtoupper($application->application_status) }} in
                                            {{ $application->updated_at->format('d M Y') }}
                                        </div>
                                        
                                        <a href="#" class="btn-view-details" data-bs-toggle="modal" data-bs-target="#applicationDetailsModal-{{ $application->id }}">
                                            <i class="icofont-eye me-1"></i>Details
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination-container">
                            {{ $applications->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </section>
            </main>
        </div>
    </div>
</div>

@foreach($applications as $application)
<div class="modal fade" id="applicationDetailsModal-{{ $application->id }}" tabindex="-1" aria-labelledby="applicationDetailsLabel-{{ $application->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-soft-primary">
                <div class="modal-title-container">
                    <h5 class="modal-title" id="applicationDetailsLabel-{{ $application->id }}">
                        <i class="icofont-briefcase me-2"></i>
                        {{ $application->jobPosting->position }}
                    </h5>
                    <span class="text-muted ms-3">
                        <i class="icofont-building me-1"></i>
                        {{ $application->jobPosting->companyProfile->company_name }}
                    </span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Job Posting Details -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="icofont-info-circle me-2"></i>Job Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Position : </strong> {{ $application->jobPosting->position }}
                                    </li>
                                    <li>
                                        <strong>Location : </strong> {{ $application->jobPosting->location->name }}
                                    </li>
                                    <li>
                                        <strong>Field of Work : </strong> {{ $application->jobPosting->fieldOfWork->name }}
                                    </li>
                                    <li>
                                        <strong>Category : </strong> {{ $application->jobPosting->jobCategory->name }}
                                    </li>
                                    <li>
                                        <strong>Salary : </strong> 
                                        @if($application->jobPosting->sembunyikan_gaji)
                                            <em>Confidential</em>
                                        @else
                                            {{ number_format($application->jobPosting->gaji, 0, ',', '.') }} IDR
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="icofont-document me-2"></i>Job Description
                                </h6>
                            </div>
                            <div class="card-body">
                                {!! $application->jobPosting->job_description !!}
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="icofont-list me-2"></i>Recruitment Requirements
                                </h6>
                            </div>
                            <div class="card-body">
                                {!! $application->jobPosting->requirements_desciption !!}
                            </div>
                        </div>
                    </div>

                    <!-- Applicant and Timeline -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="icofont-user me-2"></i>Applicant Details
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if($application->applicantProfile && $application->applicantProfile->foto)
                                        <img src="{{ asset('storage/' . $application->applicantProfile->foto) }}" 
                                            alt="Profile Picture" 
                                            class="rounded-circle mb-3" 
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" 
                                            alt="Default Profile Picture" 
                                            class="rounded-circle mb-3" 
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                    @endif

                                    <h5>{{ $application->applicantProfile->name }}</h5>
                                    <p class="text-muted">{{ $application->applicantProfile->user->email }}</p>
                                </div>

                                <hr>

                                <div class="application-links">
                                    @if($application->resume)
                                        <a href="{{ route('download.resume', $application->id) }}" 
                                           class="btn btn-outline-primary w-100 mb-2">
                                            <i class="icofont-download me-2"></i>Download Resume
                                        </a>
                                    @endif

                                    @if($application->portofolio)
                                        <a href="{{ $application->portofolio }}" 
                                           target="_blank" 
                                           class="btn btn-outline-success w-100">
                                            <i class="icofont-link me-2"></i>View Portfolio
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="icofont-clock-time me-2"></i>Application Timeline
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($application->logs && $application->logs->count() > 0)
                                    <ul class="timeline">
                                        @foreach($application->logs->sortBy('changed_at') as $log)
                                            <li>
                                                <div class="timeline-badge 
                                                    @if($log->new_status == 'applied') bg-primary
                                                    @elseif($log->new_status == 'in_review') bg-info
                                                    @elseif($log->new_status == 'interview') bg-warning
                                                    @elseif($log->new_status == 'hired') bg-success
                                                    @elseif($log->new_status == 'rejected') bg-danger
                                                    @endif">
                                                    <i class="icofont-check"></i>
                                                </div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title">
                                                            {{ ucfirst($log->previous_status) }} 
                                                            → {{ ucfirst($log->new_status) }}
                                                        </h6>
                                                        <p class="text-muted">
                                                            <small>
                                                                <i class="icofont-clock-time me-1"></i>
                                                                {{ $log->changed_at->format('d M Y H:i') }}
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted text-center">No status logs available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach


<style>
    :root {
        --primary-color: #3498db;
        --success-color: #2ecc71;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --info-color: #3498db;
        --text-color: #2c3e50;
        --background-color: #f4f6f7;
    }

    .profile-content {
        background-color: var(--background-color);
        padding: 1rem;
        border-radius: 10px;
    }

    .section-title {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        font-weight: 600;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 0.5rem;
    }

    .alert {
        display: flex;
        align-items: center;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
    }

    .alert-icon {
        margin-right: 1rem;
        font-size: 1.5rem;
    }

    .applications-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
    }

    .application-card {
        background-color: white;
        border-radius: 10px;
        border-left: 5px solid;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .application-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .application-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .job-title {
        color: var(--text-color);
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .application-card-body {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        color: var(--text-color);
    }

    .application-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        border-top: 1px solid rgba(0,0,0,0.1);
    }

    .status-badge {
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .btn-view-details {
        color: var(--primary-color);
        text-decoration: none;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .btn-view-details:hover {
        color: var(--text-color);
    }

    .no-application-message {
        text-align: center;
        padding: 3rem;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }
    .bg-soft-primary {
        background-color: rgba(52, 152, 219, 0.1);
    }

    .modal-title-container {
        display: flex;
        align-items: center;
    }

    .timeline {
        position: relative;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 15px;
        width: 2px;
        background: #e6e9ed;
    }

    .timeline > li {
        position: relative;
        margin-bottom: 20px;
    }

    .timeline-badge {
        color: #fff;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-panel {
        position: relative;
        margin-left: 50px;
        background: #fff;
        border: 1px solid #e4e4e4;
        border-radius: 4px;
        padding: 10px;
    }

    .timeline-heading {
        margin-bottom: 5px;
    }

    .application-links .btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function () {
            });
        });

        document.body.addEventListener('hidden.bs.modal', function () {
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '0';
        });
    });
</script>
@endsection