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


<section class="section doctor-qualification gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="section-title">
					<h3>My Educational Qualifications</h3>
					<div class="divider my-4"></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<div class="edu-block mb-5">
					<span class="h6 text-muted">Year(2005-2007) </span>
					<h4 class="mb-3 title-color">MBBS, M.D at University of Wyoming</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi doloremque harum, mollitia, soluta maxime porro veritatis fuga autem impedit corrupti aperiam sint, architecto, error nesciunt temporibus! Vel quod, dolor aliquam!</p>
				</div>

				<div class="edu-block">
					<span class="h6 text-muted">Year(2007-2009) </span>
					<h4 class="mb-3 title-color">M.D. of Netherland Medical College</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi doloremque harum, mollitia, soluta maxime porro veritatis fuga autem impedit corrupti aperiam sint, architecto, error nesciunt temporibus! Vel quod, dolor aliquam!</p>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="edu-block mb-5">
					<span class="h6 text-muted">Year(2009-2010) </span>
					<h4 class="mb-3 title-color">MBBS, M.D at University of Japan</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi doloremque harum, mollitia, soluta maxime porro veritatis fuga autem impedit corrupti aperiam sint, architecto, error nesciunt temporibus! Vel quod, dolor aliquam!</p>
				</div>

				<div class="edu-block">
					<span class="h6 text-muted">Year(2010-2011) </span>
					<h4 class="mb-3 title-color">M.D. of Canada Medical College</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi doloremque harum, mollitia, soluta maxime porro veritatis fuga autem impedit corrupti aperiam sint, architecto, error nesciunt temporibus! Vel quod, dolor aliquam!</p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section doctor-skills">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h3>My skills</h3>
				<div class="divider my-4"></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In architecto voluptatem alias, aspernatur voluptatibus corporis quisquam? Consequuntur, ad, doloribus, doloremque voluptatem at consectetur natus eum ipsam dolorum iste laudantium tenetur.</p>
			</div>
			<div class="col-lg-4">
				<div class="skill-list">
					<h5 class="mb-4">Expertise area</h5>
					<ul class="list-unstyled department-service">
						<li><i class="icofont-check mr-2"></i>International Drug Database</li>
						<li><i class="icofont-check mr-2"></i>Stretchers and Stretcher Accessories</li>
						<li><i class="icofont-check mr-2"></i>Cushions and Mattresses</li>
						<li><i class="icofont-check mr-2"></i>Cholesterol and lipid tests</li>
						<li><i class="icofont-check mr-2"></i>Critical Care Medicine Specialists</li>
						<li><i class="icofont-check mr-2"></i>Emergency Assistance</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar-widget  gray-bg p-4">
					<h5 class="mb-4">Make Appoinment</h5>

					<ul class="list-unstyled lh-35">
					  <li class="d-flex justify-content-between align-items-center">
					    <a href="#">Monday - Friday</a>
					    <span>9:00 - 17:00</span>
					  </li>
					  <li class="d-flex justify-content-between align-items-center">
					    <a href="#">Saturday</a>
					    <span>9:00 - 16:00</span>
					  </li>
					  <li class="d-flex justify-content-between align-items-center">
					    <a href="#">Sunday</a>
					    <span>Closed</span>
					  </li>
					</ul>

					<div class="sidebar-contatct-info mt-4">
						<p class="mb-0">Need Urgent Help?</p>
						<h3 class="text-color-2">+23-4565-65768</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection