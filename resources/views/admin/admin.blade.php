@extends('admin/layout/dashboard')
@section('content')

<div class="container-fluid py-4">
    <h3 class="font-weight-bolder text-white mb-3 mt-0">Dashboard</h3>
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">TOTAL APPLICANT</p>
                  <h5 class="font-weight-bolder">
                    {{$totalApplicant}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Company</p>
                  <h5 class="font-weight-bolder">
                    {{$totalCompany}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="fa fa-building text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total JobPosting</p>
                  <h5 class="font-weight-bolder">
                    {{$totalJobPosting}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                  <i class="fa fa-briefcase text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Application</p>
                  <h5 class="font-weight-bolder">
                    {{$totalApplication}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                  <i class="fa fa-folder-open text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-12 mt-5 mb-2">

        <div class="card shadow mb-4">

          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Latest Job Posting</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Position</th>
                            <th>Location</th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($latestJobs as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->position}}</td>
                            <td>{{$row->location->name ?? 'N/A'}}</td>
                            <td>{{$row->companyProfile->company_name ?? 'N/A'}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{route('job.view', $row->id)}}" 
                                       class="btn btn-sm btn-info mr-1">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">

        <div class="card shadow mb-4">

          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Latest Applications</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Applicant Name</th>
                            <th>Job Title</th>
                            <th>Applied at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($latestApplication as $row)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$row->applicantProfile->name}}</td>
                      <td>{{$row->jobPosting->position ?? 'N/A'}}</td>
                      <td>{{ $row->applied_at->format('d M Y') }}</td>
                      <td>
                          @if ($row->application_status == 'applied')
                              <span class="badge bg-dark text-white">
                                  {{ ucfirst($row->application_status) }}
                              </span>
                          @elseif ($row->application_status == 'in_review')
                              <span class="badge bg-info text-white">
                                  {{ ucfirst($row->application_status) }}
                              </span>
                          @elseif ($row->application_status == 'interview')
                              <span class="badge bg-warning text-dark">
                                  {{ ucfirst($row->application_status) }}
                              </span>
                          @elseif ($row->application_status == 'hired')
                              <span class="badge bg-success text-white">
                                  {{ ucfirst($row->application_status) }}
                              </span>
                          @elseif ($row->application_status == 'rejected')
                              <span class="badge bg-danger text-white">
                                  {{ ucfirst($row->application_status) }}
                              </span>
                          @endif
                      </td>
                      <td>
                          <a href="{{route('application.view', $row->id)}}" class="btn btn-sm btn-info">
                              <i class="fa fa-eye"></i> View
                          </a>
                      </td>
                  </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>

@endsection