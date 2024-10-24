@extends('admin/layout/dashboard')
@section('content')

<div class="container-fluid">
    <h3 class="font-weight-bolder text-white mb-3 mt-0">Add New Category</h3>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category_name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid
            @enderror">
                    @error('category_name')
                        <span style="color: red; font-weight: 600; font-size:9pt">{{$message}}</font-sixe:9pt></span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection