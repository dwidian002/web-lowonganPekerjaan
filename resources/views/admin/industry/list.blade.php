@extends('admin/layout/dashboard')
@section('content')

<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-12">
            <h3 class="font-weight-bolder text-white mb-3 mt-0">List Industry</h3>
        </div>
        <div class="col-lg-12" style="margin-bottom: 15px;">
            <a href="{{ route('industry.add') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add industry </a>
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
                            <th>Industry</th>
                            <th>Action</th>
                            </tr>
                    </thead>
                    <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($industry as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                                <a href="{{route('industry.edit',$row->id)}}" class="btn btn-sm btn-warning" style="color: black;"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('industry.delete',$row->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-secondary" style="color: black;"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection