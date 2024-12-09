@extends('admin/layout/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <h3 class="font-weight-bolder text-white mb-3 mt-0">List Company</h3>
        </div>
        <div class="col-lg-12" style="margin-bottom: 15px;">
            <a href="{{ route('company.add') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Add Company 
            </a>
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
                            <th>Industry</th>
                            <th>Company Type</th>
                            <th>Founding Year</th>
                            <th>Location</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($companyProfiles as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->company_name}}</td>
                            <td>{{$row->industry->name ?? 'N/A'}}</td>
                            <td>{{$row->typeCompany->name ?? 'N/A'}}</td>
                            <td>{{$row->tahun_berdiri}}</td>
                            <td>{{$row->location->name ?? 'N/A'}}</td>
                            <td>
                                @if($row->logo)
                                    <img src="{{ asset('storage/' . $row->logo) }}" 
                                         alt="Company Logo" 
                                         width="50" 
                                         height="50" 
                                         style="object-fit: cover; border-radius: 5px;">
                                @else
                                    <span>No Logo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{route('company.detail', $row->id)}}" 
                                       class="btn btn-sm btn-info mr-1">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                    <a href="{{route('company.edit', $row->id)}}" 
                                       class="btn btn-sm btn-warning mr-1" 
                                       style="color: black;">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{route('company.delete', $row->id)}}" 
                                       onclick="return confirm('Are you sure?')" 
                                       class="btn btn-sm btn-secondary" 
                                       style="color: black;">
                                        <i class="fa fa-trash"></i> Delete
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