@extends('company.layout.main')
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">Edit Job Posting</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section job-posting-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="job-img-block">
                    @if ($jobPosting->companyProfile && $jobPosting->companyProfile->logo)
                        <img src="{{ asset('storage/' . $jobPosting->companyProfile->logo) }}" alt="{{ $jobPosting->companyProfile->company_name }}" style="max-width: 160px; height: 160px; object-fit: cover;">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-logo.png') }}" alt="Default Logo" style="max-width: 100%; height: 200px; object-fit: cover;">
                    @endif
                    <div class="info-block mt-4">
                        <h4 class="mb-0">{{$jobPosting->companyProfile->company_name}}</h4>
                        <p>{{$jobPosting->companyProfile->industry->name}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="job-details mt-4 mt-lg-0">
                    <h2 class="text-md">Edit Job Posting</h2>
                    <div class="divider my-4"></div>

                    <form action="{{ route('job-posting.update', $jobPosting->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="position">Job Position</label>
                            <input type="text" class="form-control" name="position" id="position" value="{{ old('position', $jobPosting->position) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Job Location</label>
                            <select class="form-control" name="location_id" id="location">
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ $jobPosting->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gaji">Salary</label>
                            <input type="number" class="form-control" name="gaji" id="gaji" value="{{ old('gaji', $jobPosting->gaji) }}" required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="hidden" name="sembunyikan_gaji" value="0">
                            <input type="checkbox" class="form-check-input" name="sembunyikan_gaji" id="hideSalary" value="1" {{ $jobPosting->sembunyikan_gaji ? 'checked' : '' }}>
                            <label class="form-check-label" for="hideSalary">Hide Salary</label>
                        </div>

                        <div class="form-group">
                            <label>Field of Work</label>
                            <select name="field_of_work_id" class="form-control" required>
                                <option value="">Select Field of Work</option>
                                @foreach($field_of_work as $field)
                                    <option value="{{ $field->id }}" {{ $jobPosting->field_of_work_id == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <textarea class="form-control" name="job_description" id="job_description" rows="5" required>{{ old('job_description', $jobPosting->job_description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="requirements_desciption">Requirements</label>
                            <textarea class="form-control" name="requirements_desciption" id="requirements_desciption" rows="5" required>{{ old('requirements_desciption', $jobPosting->requirements_desciption) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Job Category</label>
                            <select class="form-control" name="job_category_id" id="category">
                                @foreach($jobCategories as $category)
                                    <option value="{{ $category->id }}" {{ $jobPosting->job_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{ $jobPosting->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$jobPosting->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-main-2 btn-round-full mt-3">Update Job Posting<i class="icofont-simple-right ml-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
