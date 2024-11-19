@extends('applicant.layout.main')
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
					<h1 class="text mb-3 mt-3" style="color: dark;">Your Most Trusted Job partner</h1> 
					<p class="text-small">
                   — start applying now and create the career you dream of!
                   </p>
                    <div>
					<div class="sidebar-widget search  mb-0">
						<h4 class="text-small">What Job Are You Looking For?</h4>
						<form action="{{ route('job-postings.all') }}" method="GET">
							<div class="search-wrapper">
								<div class="search-input-container">
									<input type="text" name="search" class="search-input" placeholder="Search Companies">
								</div>
								<div class="select-container">
									<select name="lokasi" class="select-input">
										<option value="">Pilih Lokasi</option>
										@foreach($locations as $location)
											<option value="{{ $location->id }}">{{ $location->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="select-container">
									<select name="category" class="select-input">
										<option value="">Pilih Kategori</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="select-container">
									<select name="fields" class="select-input">
										<option value="">Pilih Bidang</option>
										@foreach($fields as $field)
											<option value="{{ $field->id }}">{{ $field->name }}</option>
										@endforeach
									</select>
								</div>
								<button type="submit" class="btn btn-main-2 btn-icon btn-round-full">SEARCH</button>
							</div>
						</form>
					</div>
				</div>
				<div class="divider mtn-3"></div>
			</div>
		</div>
	</div>
</div>
</section>

<section class="features mtn-1000 mb-10y">
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
									<a href="{{ route('company.detail', $job->companyProfile->id) }}" class="company-name-link">
										<h5 class="company-name">{{ $job->companyProfile->company_name }}</h5>
									</a>
								</div>
							</div>
							
							<a href="{{ route('job.detail', $job->id) }}" class="text-decoration-none text-dark">
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
				<a href="{{ route('job-postings.all') }}" class="btn btn-main-2">
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
						<i class="icofont-doctor"></i>
						<span class="h3">58</span>k
						<p>Company Partner</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-flag"></i>
						<span class="h3">700</span>+
						<p>Job Postings</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-badge"></i>
						<span class="h3">40</span>+
						<p>Applayed</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-globe"></i>
						<span class="h3">20</span>
						<p>Applicant</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section service gray-bg" style="margin-bottom: -100px;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title" style="margin-bottom: 30px">
					<h2 class="text-small">Field Of Jobs</h2>
					<div class="divider mx-auto my-4"></div>
					<p>Find various vacancies by job field.</p>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach($fields as $field)
			<div class="col-lg-4 col-md-6 col-sm-6">
				<a href="{{ route('job-postings.all', ['bidang' => $field->id]) }}" class="text-decoration-none">
					<div class="service-item mb-4">
						<div class="icon d-flex align-items-center">
							@switch($field->name)
								@case('Programing & Sofftware Development')
									<i class="icofont-code text-lg"></i>
									@break
								@case('IT Consultancy & Advisory')
									<i class="icofont-business-man text-lg"></i>
									@break
								@case('Network & Infrastructure')
									<i class="icofont-network text-lg"></i>
									@break
								@case('Data Management System')
									<i class="icofont-database text-lg"></i>
									@break
								@case('IT Security & Compliance')
									<i class="icofont-shield text-lg"></i>
									@break
								@case('Other')
									<i class="icofont-gear text-lg"></i>
									@break
								@case('Sales')
									<i class="icofont-chart-growth text-lg"></i>
									@break
								@case('Desain Komunikasi Visual')
									<i class="icofont-paint text-lg"></i>
									@break
								@case('Information System & Technology Development')
									<i class="icofont-server text-lg"></i>
									@break
								@default
									<i class="icofont-gear text-lg"></i>
							@endswitch
							<h4 class="mt-3 mb-3">{{ $field->name }}</h4>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section>
<section class="section clients " style="margin-top: -135px;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7" style="margin-bottom: 15px;">
				<div class="section-title text-center">
					<h2>Company Partner</h2>
					<div class="divider mx-auto my-4"></div>
					<p>We collaborate with various leading companies that open up opportunities for you to develop and achieve your dream career goals.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container" >
		<div class="row clients-logo">
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/pertamina.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/pln.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/astra.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/del.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/bni.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/mind.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/bri.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/sm.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/adr.jpg" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="client-thumb">
					<img src="layout/assets/images/about/bca.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 13px">
			<div class="col-lg-12 text-center mt-4 mb-10">
				<a href="{{ route('list.company') }}" class="btn btn-main-2">
					See All Companies <i class="icofont-simple-right ml-2"></i>
				</a>
			</div>
		</div>
	</div>
</section>
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