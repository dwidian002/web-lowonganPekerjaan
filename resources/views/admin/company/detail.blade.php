@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <h3 class="font-weight-bolder text-white mb-3 mt-0">
                Detail Of : {{ $company->company_name }}
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg mb-4 border-left-primary">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Company Logo</h6>
                </div>
                <div class="card-body text-center">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" 
                             alt="Company Logo" 
                             class="img-fluid rounded shadow" 
                             style="max-height: 250px; object-fit: cover;">
                    @else
                        <p class="text-muted">No Logo Available</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-lg mb-4 border-left-success">
                <div class="card-header py-3 bg-gradient-success text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Company Information</h6>
                    <div>
                        <a href="#"
                        {{-- <a href="{{ route('company.delete', $company->id) }}" --}}
                           onclick="return confirm('Are you sure you want to delete this company profile? All associated job postings will also be deleted.')"
                           class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-primary">Name:</strong> {{ $company->company_name }}<br>
                            <strong class="text-primary">Industry:</strong> {{ $company->industry->name ?? 'N/A' }}<br>
                            <strong class="text-primary">Company Type:</strong> {{ $company->typeCompany->name ?? 'N/A' }}<br>
                            <strong class="text-primary">Founding Year:</strong> {{ $company->tahun_berdiri }}<br>
                        </div>
                        <div class="col-md-6">
                            <strong class="text-primary">Location:</strong> {{ $company->location->name ?? 'N/A' }}<br>
                            <strong class="text-primary">Full Address:</strong> {{ $company->alamat_lengkap }}<br>
                            <strong class="text-primary">Website:</strong> 
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="text-info">{{ $company->website }}</a>
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg mb-4 border-left-warning">
        <div class="card-header py-3 bg-gradient-warning text-white">
            <h6 class="m-0 font-weight-bold">Company Description</h6>
        </div>
        <div class="card-body">
            <p>{{ $company->description }}</p>
        </div>
    </div>

    <div class="card shadow-lg mb-4 border-left-info">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-gradient-info text-white">
            <h6 class="m-0 font-weight-bold">Job Postings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Field Of Work</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($company->jobPostings as $job)
                        <tr>
                            <td>{{ $job->position }}</td>
                            <td>{{ $job->location->name }}</td>
                            <td>{{ $job->fieldOfWork->name }}</td>
                            <td>{{ $job->jobCategory->name }}</td>
                            <td>
                                <span class="badge 
                                    {{ $job->status  ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $job->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group"> 
                                    <a href="{{ route('job.view', $job->id) }}" 
                                       class="btn btn-sm btn-info mr-1">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No Job Postings Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection