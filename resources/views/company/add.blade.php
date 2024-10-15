@extends('layoutadmin/dashboard')
@section('content')

<div class="container-fluid">
    <h3 class="font-weight-bolder text-white mb-3 mt-0">Add New Company</h3>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('company.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid
            @enderror">
                    @error('name')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{$message}}</font-sixe:9pt></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Industri</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid
            @enderror">
                    @error('name')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{$message}}</font-sixe:9pt></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Tahun Berdiri</label>
                    <input type="year" name="tahun_berdiri" class="form-control" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <select name="location"
                        class="form-control @error('location_id') is-invalid
                    @enderror">
                    <option value="">-- Select Location --</option>
                        @foreach ($location as $row)
                            <option value="{{ $row->location_id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                    @error('location_id')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</font-sixe:9pt></span>
                    @enderror
                </div>
                 <div class="mb-3">
                    <label for="alamat_lengkap" class="form-label">Address</label>
                    <textarea name="alamat_lengkap" class="form-control" rows="3" placeholder="" required></textarea>
                    </div>
                <div class="mb-3">
                    <label for="logo">Logo Company (Optional)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('company.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection
