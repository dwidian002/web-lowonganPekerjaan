@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <h3 class="font-weight-bolder text-white mb-3 mt-0">List Job Postings</h3>
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
                            <th>Position</th>
                            <th>Location</th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($jobPosting as $row)
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
@endsection