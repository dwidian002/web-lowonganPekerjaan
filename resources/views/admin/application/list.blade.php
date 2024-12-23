@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <h3 class="font-weight-bolder text-white mb-3 mt-0">List Company</h3>
        </div>
    </div>

    @if (session()->has('pesan'))
    <div class="alert alert-{{session()->get('pesan')[0]}}">
        {{session()->get('pesan')[1]}}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Job Title</th>
                            <th>Applied At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($applications as $row)
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
@endsection