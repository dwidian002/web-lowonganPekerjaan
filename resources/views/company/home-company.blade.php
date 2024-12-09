@extends('company.layout.main')
@section('content')

<section class="banner">
	<div class="container">
        @if (session('incomplete_profile'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('incomplete_profile') }}</strong>
            <div class="mt-2">
                <a href="{{ route('exs.form') }}" class="btn btn-primary">Lengkapi Sekarang</a>
                <button type="button" class="btn btn-secondary" id="dismissAlert">Nanti Saja</button>
            </div>
        </div>
        @endif
		<div class="row">
			<div class="col-lg-6 col-md-12 col-xl-7" style="margin-bottom: -70px;">
				<div class="block">
					<div class="divider mb-3"></div>
					<span class="text-small text-sm letter-spacing " style="color: dark;">The Best Job Search Solution</span>
					<h1 class="mb-3 mt-3" style=" bold; color: dark;">Your Most Trusted Job partner</h1> 
					<p class="text-small">
                   — start applying now and create the career you dream of!
                   </p>
                    <div>
                    <div class="divider mb-5"></div>
					<div class="btn-container mb-3">
						<a href="{{route('job-posting.add')}}" class="btn btn-main-2 btn-icon btn-round-full">Create Your New Job Posting <i class="icofont-simple-right ml-2  "></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<section class="features mtn-10000">
	<div class="container">
		<div class="row">
			<div class="col-12 mb-2">
				<h2 class="text-small">Latest Job Postings</h2>
			</div>
			
			@forelse($latestJobs as $job)
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100 shadow job-card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-3">
								<div class="company-logo mr-3">
									@if ($job->companyProfile && $job->companyProfile->logo)
										<img src="{{ asset('storage/' . $job->companyProfile->logo) }}" 
											 alt="{{ $job->companyProfile->company_name }}" 
											 class="rounded"
											 style="width: 50px; height: 50px; object-fit: cover;">
									@else
										<img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" 
											 alt="Default Logo" 
											 class="rounded"
											 style="width: 50px; height: 50px; object-fit: cover;">
									@endif
								</div>
								<div>
									<a href="{{ route('profile-company', $job->companyProfile->id) }}" class="company-name-link">
										<h5 class="company-name">{{ $job->companyProfile->company_name }}</h5>
									</a>
								</div>
							</div>
							
							<a href="{{ route('job-posting.show', $job->id) }}" class="text-decoration-none text-dark">
								<h4 class="job-title mb-3 job-title-link">{{ $job->position }}</h4>
			
								<div class="job-tags mb-3">
									<span class="badge {{ $job->status ? 'badge-success' : 'badge-secondary' }}">
										{{ $job->status ? 'Active' : 'Inactive' }}
									</span>
									<span class="badge badge-info mr-2">{{ $job->jobCategory->category_name }}</span>
									<span class="badge badge-primary mr-2">{{ $job->fieldOfWork->name }}</span>
								</div>
			
								<div class="job-info">
									<div class="d-flex align-items-center mb-2">
										<i class="icofont-money mr-2 text-warning"></i>
										@if($job->sembunyikan_gaji)
											<span class="font-italic text-muted">(disembunyikan)</span>
										@else
											<span>Rp {{ number_format($job->gaji, 0, ',', '.') }}</span>
										@endif
									</div>
									<div class="d-flex align-items-center">
										<i class="icofont-location-pin mr-2 text-danger"></i>
										<span>{{ $job->location->name }}</span>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			@empty
				<div class="col-12 text-center">
					<p>Tidak ada lowongan pekerjaan tersedia saat ini.</p>
				</div>
			@endforelse
		</div>
	
		<div class="row">
			<div class="col-lg-12 text-center mt-4 mb-10">
				<a href="{{ route('job-posting.index') }}" class="btn btn-main-2">
					View All Jobs <i class="icofont-simple-right ml-2"></i>
				</a>
			</div>
		</div>
	</div>
</section>


<section class="cta-section" style="margin-top: 50px;">
	<div class="container mt-100">
		<div class="cta position-relative">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6 mt-10">
					<div class="counter-stat">
						<i class="icofont-search-job"></i>
						<span class="h3">{{$totalJobPosting}}</span>
						<p>Total Job Posting</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-search-job"></i>
						<span class="h3">{{$totalApplication}}</span>
						<p>Total Application</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-list"></i>
						<span class="h3">{{$totalAcceptedApplication}}</span>
						<p>Total Application Hired</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-users-alt-2"></i>
						<span class="h3">{{$totalApplicant}}</span>
						<p>Applicants Who Applied</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section service gray-bg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title" style="margin-bottom: 30px">
					<h2 class="text-small">Latest Applications</h2>
					<div class="divider mx-auto my-4"></div>
				</div>
			</div>
		</div>

		<div class="row">
            @forelse($latestApplications as $application)
            <div class="col-lg-4 col-md-6 mb-4">
                @if ($application->application_status == 'applied')
                <a href="#" data-toggle="modal" data-target="#confirmModal-{{ $application->id }}" 
                   data-application="{{ $application->user->applicantProfile->name }}">
                @else
                    <a href="{{ route('company.application.detail', $application->id) }}">
                @endif
                    <div class="card h-100 shadow job-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-foto mr-3">
                                    @if ($application->user->applicantProfile && $application->user->applicantProfile->foto)
                                        <img src="{{ asset('storage/' . $application->user->applicantProfile->foto) }}"
                                             alt="{{ $application->user->applicantProfile->name }}"
                                             class="rounded"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}"
                                             alt="Default foto"
                                             class="rounded"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <h2 class="job-title mb-3 position">{{ $application->user->applicantProfile->name }}</h2> 
									</div>
                            </div>
        
                            <div class="job-info">
								<div class="d-flex align-items-center mb-2">
									<a href="{{ route('job-posting.show', $application->jobPosting->id) }}" class="company-name-link">
										<i class="icofont-search-job text-primary"></i>
										<span class="ml-2">Applied for:  {{ $application->jobPosting->position }}</span>
									</a>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="icofont-calendar text-primary"></i>
                                    <span class="ml-2">Applied at: {{ $application->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer px-4 py-3 d-flex justify-content-between align-items-center
                            @if ($application->application_status == 'applied')
                                bg-dark text-white
                            @elseif ($application->application_status == 'in_review')
                                bg-info text-white
                            @elseif ($application->application_status == 'interview')
                                bg-warning text-dark
                            @elseif ($application->application_status == 'hired')
                                bg-success text-white
                            @elseif ($application->application_status == 'rejected')
                                bg-danger text-white
                            @else
                                bg-white border-top
                            @endif">
                            <span class="text-sm">{{ strtoupper($application->application_status) }}</span>
                            <span class="text-sm">{{ $application->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
			<div class="col-12 text-center">
				<p>Tidak ada application tersedia saat ini.</p>
			</div>
            @endforelse  
        </div>
		<div class="row">
			<div class="col-lg-12 text-center mt-4 mb-10">
				<a href="{{ route('application.index') }}" class="btn btn-main-2">
					View All Application
				</a>
			</div>
		</div>
	</div>
	@foreach($latestApplications as $application)
        @if ($application->application_status == 'applied')
        <div class="modal fade" id="confirmModal-{{ $application->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Confirm Application Review
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to review the application for 
                        {{ $application->user->applicantProfile->name }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a href="{{ route('company.application.detail', $application->id) }}?confirmed" 
                           class="btn btn-primary">Yes</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</section>
<script>
    $('#confirmModal').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget);
        $('#confirmModal .btn-primary').attr('href', link.attr('href'));
    });
</script>
<!-- footer Start -->
<footer class="footer section gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mr-auto col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<div class="logo mb-4">
						<img src="layout/assets/images/logo.png" alt="" class="img-fluid">
					</div>
					<p>Tempora dolorem voluptatum nam vero assumenda voluptate, facilis ad eos obcaecati tenetur veritatis eveniet distinctio possimus.</p>

					<ul class="list-inline footer-socials mt-4">
						<li class="list-inline-item"><a href="https://www.facebook.com/themefisher"><i class="icofont-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/themefisher"><i class="icofont-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.pinterest.com/themefisher/"><i class="icofont-linkedin"></i></a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Department</h4>
					<div class="divider mb-4"></div>

					<ul class="list-unstyled footer-menu lh-35">
						<li><a href="#">Surgery </a></li>
						<li><a href="#">Wome's Health</a></li>
						<li><a href="#">Radiology</a></li>
						<li><a href="#">Cardioc</a></li>
						<li><a href="#">Medicine</a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-2 col-md-6 col-sm-6">
				<div class="widget mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Support</h4>
					<div class="divider mb-4"></div>

					<ul class="list-unstyled footer-menu lh-35">
						<li><a href="#">Terms & Conditions</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Company Support </a></li>
						<li><a href="#">FAQuestions</a></li>
						<li><a href="#">Company Licence</a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="widget widget-contact mb-5 mb-lg-0">
					<h4 class="text-capitalize mb-3">Get in Touch</h4>
					<div class="divider mb-4"></div>

					<div class="footer-contact-block mb-4">
						<div class="icon d-flex align-items-center">
							<i class="icofont-email mr-3"></i>
							<span class="h6 mb-0">Support Available for 24/7</span>
						</div>
						<h4 class="mt-2"><a href="tel:+23-345-67890">Support@email.com</a></h4>
					</div>

					<div class="footer-contact-block">
						<div class="icon d-flex align-items-center">
							<i class="icofont-support mr-3"></i>
							<span class="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
						</div>
						<h4 class="mt-2"><a href="tel:+23-345-67890">+23-456-6588</a></h4>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-btm py-4 mt-5">
			<div class="row align-items-center justify-content-between">
				<div class="col-lg-6">
					<div class="copyright">
						&copy; Copyright Reserved to <span class="text-color">WonderWoman</span> by <a href="https://themefisher.com/" target="_blank">Themefisher</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="subscribe-form text-lg-right mt-5 mt-lg-0">
						<form action="#" class="subscribe">
							<input type="text" class="form-control" placeholder="Your Email address">
							<a href="#" class="btn btn-main-2 btn-round-full">Subscribe</a>
						</form>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4">
					<a class="backtop js-scroll-trigger" href="#top">
						<i class="icofont-long-arrow-up"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>
<script>
    document.getElementById('dismissAlert').addEventListener('click', function() {
        var alert = this.closest('.alert');
        alert.classList.remove('show');
        setTimeout(function() {
            alert.remove();
        }, 150);
    });
</script>
@endsection