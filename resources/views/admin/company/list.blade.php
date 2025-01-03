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
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Industry</th>
                            <th>Company Type</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($companyProfiles as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>
                                @if($row->logo)
                                    <img src="{{ asset('storage/' . $row->logo) }}" 
                                         alt="Company Logo" 
                                         width="50" 
                                         height="50" 
                                         style="object-fit: cover; border-radius: 5px;">
                                @else
                                    <img src="{{ asset('layout/assets/images/service/default-logo.png') }}"
                                        alt="Default logo"
                                        width="50"
                                        height="50"
                                        style="object-fit: cover; border-radius: 5px;">
                                @endif
                            </td>
                            <td>{{$row->company_name}}</td>
                            <td>{{$row->industry->name ?? 'N/A'}}</td>
                            <td>{{$row->typeCompany->name ?? 'N/A'}}</td>
                            <td>{{$row->location->name ?? 'N/A'}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{route('company.view', $row->id)}}" 
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