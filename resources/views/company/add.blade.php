@extends('layoutadmin/dashboard')
@section('content')

<div class="container-fluid">
    <h3 class="font-weight-bolder text-white mb-3 mt-0">Add New Company</h3>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}"
                           class="form-control @error('company_name') is-invalid @enderror">
                    @error('company_name')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Industry</label>
                    <input type="text" name="industry" value="{{ old('industry') }}"
                           class="form-control @error('industry') is-invalid @enderror">
                    @error('industry')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Year Founded</label>
                    <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}"
                           class="form-control @error('tahun_berdiri') is-invalid @enderror">
                    @error('tahun_berdiri')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <select name="location"
                            class="form-control @error('location') is-invalid @enderror">
                        @foreach ($location as $row)
                            <option value="{{ $row->id }}" {{ old('location') == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    @error('location')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}"
                           class="form-control @error('alamat_lengkap') is-invalid @enderror">
                    @error('alamat_lengkap')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" value="{{ old('website') }}"
                           class="form-control @error('website') is-invalid @enderror">
                    @error('website')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo">Company Logo (Optional)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('company.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection
