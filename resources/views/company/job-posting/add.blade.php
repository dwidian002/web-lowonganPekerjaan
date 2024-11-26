@extends('company.layout.main')
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">Form Create New Job Posting</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Doctor Details</a></li>
          </ul> -->
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
                    <div class="job-img-block">
                        @if ($companyProfile && $companyProfile->logo)
                            <img src="{{ asset('storage/' . $companyProfile->logo) }}" alt="{{ $companyProfile->company_name }}" style="max-width: 160px; height: 160px; object-fit: cover;">
                        @else
                            <img src="{{ asset('layout/assets/images/service/default-logo.png') }}" alt="Default Logo" style="max-width: 100%; height: 200px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="info-block mt-4">
                        <h4 class="mb-0">{{$companyProfile->company_name}}</h4>
                        <p>{{$companyProfile->industry->name}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="job-details mt-4 mt-lg-0">
                    <h2 class="text-md">Add Job Posting</h2>
                    <div class="divider my-4"></div>

                    <form action="{{ route('job-posting.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="position">Job Position</label>
                            <input type="text" class="form-control" name="position" id="position" placeholder="Enter job position" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Job Location</label>
                            <select class="form-control" name="location_id" id="location">
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gaji">Salary</label>
                            <input type="number" class="form-control" name="gaji" id="gaji" placeholder="Enter salary" required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" name="sembunyikan_gaji" id="hideSalary" value="1">
                            <label class="form-check-label" for="hideSalary">Hide Salary</label>
                        </div>

                        <div class="form-group">
                            <label>Field of Work</label>
                            <select name="field_of_work_id" class="form-control" required>
                                <option value="">Select Field of Work</option>
                                @foreach($fieldOfWorks as $field)
                                    <option value="{{ $field->id }}" {{ old('field_of_work_id') == $field->id ? 'selected' : '' }}>
                                        {{ $field->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <textarea class="form-control" name="job_description" id="job_description" rows="5" placeholder="Enter job description (use new lines for list items)" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="requirements_description">Requirements</label>
                            <textarea class="form-control" name="requirements_description" id="requirements_description" rows="5" placeholder="Enter job requirements" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Job Category</label>
                            <select class="form-control" name="job_category_id" id="category">

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-main-2 btn-round-full mt-3">Submit Job Posting<i class="icofont-simple-right ml-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection