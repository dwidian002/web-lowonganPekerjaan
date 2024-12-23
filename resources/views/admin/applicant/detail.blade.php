@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <h3 class="font-weight-bolder text-white mb-3 mt-0">
                Detail Of: {{ $applicant->name }}
            </h3>
            
            <a href="{{ route('applicant.delete', $applicant->id) }}"
               onclick="return confirm('Are you sure you want to delete this applicant profile? All associated applications will also be deleted.')"
               class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i> Delete
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg mb-4 border-left-primary">
                <div class="card-header py-1 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Profile Photo</h6>
                </div>
                <div class="card-body text-center">
                    @if($applicant->foto)
                        <img src="{{ asset('storage/' . $applicant->foto) }}" 
                             alt="Applicant Photo" 
                             class="img-fluid rounded-circle mb-3" 
                             style="max-width: 150px;">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" 
                             alt="Default Photo" 
                             class="img-fluid rounded-circle mb-3" 
                             style="max-width: 150px;">
                    @endif
                    <h4 class="card-title mb-0">{{ $applicant->name }}</h4>
                    <div class="text-muted mb-2">{{ $applicant->user->email }}</div>
    
                </div>
            </div>
    
            <div class="card shadow-lg mb-4 border-left-success">
                <div class="card-header py-1 bg-gradient-success text-white">
                    <h6 class="m-0 font-weight-bold">Personal Information</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="far fa-calendar-alt mr-2"></i> {{ $applicant->tanggal_lahir }}</li>
                        <li class="mb-2"><i class="fas fa-venus-mars mr-2"></i> {{ $applicant->gender }}</li>
                        <li class="mb-2"><i class="fas fa-phone mr-2"></i> {{ $applicant->phone_number }}</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> {{ $applicant->alamat_lengkap }}</li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="col-lg-8">
            <div class="card shadow-lg mb-4 border-left-primary">
                <div class="card-header py-1 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Work Experiences</h6>
                </div>
                <div class="card-body">
                    @forelse($applicant->experiences as $experience)
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
                    @forelse($applicant->educations as $education)
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
                    @forelse($applicant->skills as $skill)
                        <span class="badge bg-primary text-white rounded-pill px-3 py-2 me-2 mb-2 d-inline-block" style="font-size: 0.9rem;">
                            {{ $skill->name }}
                        </span>
                    @empty
                        <p class="text-muted">No skills available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg mb-4 border-left-info">
        <div class="card-header py-1 bg-gradient-info text-white">
            <h6 class="m-0 font-weight-bold">About</h6>
        </div>
        <div class="card-body">
            <p>{!! nl2br(e($applicant->about_me)) !!}</p>
        </div>
    </div>

    <div class="card shadow-lg mb-4 border-left-info">
        <div class="card-header py-1 bg-gradient-info text-white">
            <h6 class="m-0 font-weight-bold">Applied Jobs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Applied At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicant->applications as $application)
                        <tr>
                            <td>{{ $application->jobPosting->position }}</td>
                            <td>{{ $application->jobPosting->companyProfile->company_name }}</td>
                            <td>{{ $application->applied_at->format('d M Y') }}</td>
                            <td>
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
                            </td>
                            <td>
                                <a href="{{route('application.view', $application->id)}}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No Applications Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection