@extends('company.layout.main')
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
                        <p class="section-text">{!! nl2br(e($jobPosting->job_description)) !!}</p>
                    </div>

                    <div class="content-section mb-4">
                        <h3 class="section-title">Requirements Description</h3> 
                        <p class="section-text"> {!! nl2br(e($jobPosting->requirements_desciption)) !!}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 mt-5">
                <div class="apply-button-wrapper mb-4">
                    @if ($jobPosting->status == 1)
                        <a href="{{ route('job-posting.close', $jobPosting->id) }}" class="btn btn-secondary btn-apply w-100">
                            <i class="icofont-not-allowed"></i> Close Job
                        </a>
                    @else
                        <a href="{{ route('job-posting.open', $jobPosting->id) }}" class="btn btn-success btn-apply w-100">
                            <i class="icofont-search-job"></i> Open Job
                        </a>
                    @endif
                </div>
                <div class="apply-button-wrapper mb-4">
                    <a href="{{route('job-posting.edit',$jobPosting->id)}}" class="btn btn-warning btn-apply w-100"><i class="icofont-edit"></i> Edit Job</a>
                </div>
                
                <div class="company-sidebar">
                    <div class="sidebar-item">
                        <i class="icofont-money mr-2 text-warning"></i>
                        @if($jobPosting->sembunyikan_gaji)
                            <span class="font-italic text-muted">Rp {{ number_format($jobPosting->gaji, 0, ',', '.') }} (disembunyikan)</span>
                        @else
                            <span>Rp {{ number_format($jobPosting->gaji, 0, ',', '.') }}</span>
                        @endif
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

<section class="section job-postings">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Application</h3>
                <div class="divider my-4 mb-4"></div>
            </div>
        </div>
        <div class="row">
            @forelse($jobPosting->applications as $application)
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
                                    <h4 class="job-title mb-3 position">{{ $application->user->applicantProfile->name }}</h4>       
                                </div>
                            </div>
        
                            <div class="job-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="icofont-calendar text-primary"></i>
                                    <span class="ml-2">Applied at: {{ $application->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="icofont-email text-danger"></i>
                                    <span class="ml-2"> {{ $application->user->email }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="icofont-phone text-dark"></i>
                                    <span class="ml-2">{{ $application->user->applicantProfile->phone_number }}</span>
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
            @endforelse  
        </div>
    </div>

    @foreach($jobPosting->applications as $application)
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




@endsection