@extends('layoutcompany.main')
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">{{$companies->company_name}}</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section company-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="company-logo">
                    @if ($companies->logo)
                        <img src="{{ asset('storage/' . $companies->logo) }}" alt="{{ $companies->company_name }}" class="logo-img">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" alt="Default Logo" class="logo-img">
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="company-header mb-4">
                    <h2 class="company-title">{{$companies->company_name}}</h2>
                </div>

                <div class="company-content">
                    <div class="content-section mb-4">
                        <h3 class="section-title">Description</h3>
                        <p class="section-text">{{ $companies->description }}</p>
                    </div>

                    <div class="content-section mb-4">
                        <h3 class="section-title">Year Founded</h3>
                        <p class="section-text">{{ $companies->tahun_berdiri }}</p>
                    </div>

                    <div class="content-section">
                        <h3 class="section-title">Address</h3>
                        <p class="section-text">{{ $companies->alamat_lengkap }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="company-sidebar">
                    <div class="sidebar-item">
                        <i class="icofont-industries-2 mr-2 text-warning"></i>
                        <span>{{ $companies->industry->name }}</span>
                    </div>
                    <div class="sidebar-item">
                        <i class="icofont-location-pin mr-2 text-danger"></i>
                        <span>{{ $companies->location->name }}</span>
                    </div>
                    <div class="sidebar-item">
                        <i class="icofont-web mr-2 text-info"></i>
                        <a href="{{ $companies->website }}" target="_blank">{{ $companies->website }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section job-postings">
    <div class="container">
        <div class="row">
            <div class="col-12">
				<h3>Job Posted</h3>
				<div class="divider my-4 mb-4"></div>
            </div>
        </div>
        
        <div class="row">
			@forelse($companies->jobPostings as $jobPosting)
			<div class="col-lg-4 col-md-6 mb-4">
				<a href="{{ route('job-posting.show', $jobPosting->id) }}" class="card-link-wrapper">
					<div class="card h-100 shadow job-card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-3">
								<div class="company-logo mr-3">
									@if ($jobPosting->companyProfile && $jobPosting->companyProfile->logo)
										<img src="{{ asset('storage/' . $jobPosting->companyProfile->logo) }}" 
											 alt="{{ $jobPosting->companyProfile->company_name }}" 
											 class="rounded">
									@else
										<img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" 
											 alt="Default Logo" 
											 class="rounded">
									@endif
								</div>
								<div>
									<h5 class="company-name">{{ $jobPosting->companyProfile->company_name }}</h5>
								</div>
							</div>
		
							<h4 class="job-title mb-3">{{ $jobPosting->position }}</h4>
		
							<div class="job-tags mb-3">
								<span class="badge badge-info mr-2">{{ $jobPosting->jobCategory->category_name }}</span>
								<span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-secondary' }}">
									{{ $jobPosting->status ? 'Active' : 'Inactive' }}
								</span>
								<span class="badge badge-primary mr-2">{{ $jobPosting->fieldOfWork->name }}</span>
							</div>
		
							<div class="job-info">
								@unless($jobPosting->sembunyikan_gaji)
									<div class="d-flex align-items-center mb-2">
										<i class="icofont-money mr-2 text-warning"></i>
										<span>Rp {{ number_format($jobPosting->gaji, 0, ',', '.') }}</span>
									</div>
								@endunless
								<div class="d-flex align-items-center">
									<i class="icofont-location-pin mr-2 text-danger"></i>
									<span>{{ $jobPosting->location->name }}</span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			@empty
			<div class="col-12 text-center">
				<p>No job postings found.</p>
			</div>
			@endforelse
		</div>

    </div>
</section>

<style>
	/* Existing Page & Section Styles */
	.company-single {
		padding: 60px 0 30px; 
	}
	
	.job-postings {
		background-color: #f8f9fa;
		padding: 80px 0;
		margin-top: 2rem;
	}
	
	/* Company Profile Styles */
	.company-logo {
		padding-right: 2rem;
	}
	
	.company-logo .logo-img {
		width: 150px;
		height: 150px;
		object-fit: cover;
		border: 1px solid #eee;
		border-radius: 8px;
	}
	
	.company-title {
		font-size: 2.5rem;
		color: #223a66;
		font-weight: 600;
		margin-bottom: 2rem;
	}
	
	.content-section {
		margin-bottom: 2rem;
	}
	
	.section-title {
		font-size: 1.5rem;
		color: #223a66;
		margin-bottom: 0.75rem;
		font-weight: 600;
	}
	
	.section-text {
		color: #6c757d;
		font-size: 1rem;
		line-height: 1.7;
	}
	
	.company-sidebar {
		padding-top: 3.7rem;
	}
	
	.sidebar-item {
		display: flex;
		align-items: center;
		padding: 12px 0;
		border-bottom: 1px solid #eee;
	}
	
	.sidebar-item:last-child {
		border-bottom: none;
	}
	
	.sidebar-item i {
		font-size: 1.2rem;
		width: 30px;
	}
	
	.sidebar-item a {
		color: #6c757d;
		text-decoration: none;
		word-break: break-all;
	}
	
	.sidebar-item a:hover {
		color: #223a66;
	}
	
	/* Job Card Styles */
	.job-card {
		transition: transform 0.2s ease-in-out;
		border-radius: 12px;
		cursor: pointer;
		border: none;
	}
	
	.job-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
	}
	
	/* Job Card Company Logo Styles */
	.card .company-logo {
		display: flex;
		align-items: center;
		padding-right: 0;
	}
	
	.card .company-logo img {
		width: 70px !important;
		height: 70px !important;
		border: 1px solid #edf2f7;
		object-fit: cover;
		border-radius: 8px;
	}
	
	.company-name {
		color: #333;
		font-size: 1.5rem !important;
		font-weight: 600;
		line-height: 1.2;
		margin-bottom: 0;
		transition: color 0.2s ease;
	}
	
	.company-name:hover {
		color: #e82454;
		text-decoration: none;
	}
	
	.job-title {
		font-size: 1.25rem;
		font-weight: 600;
		color: #2d3748;
	}
	
	.job-tags .badge {
		font-size: 0.8rem;
		font-weight: 500;
		padding: 0.5em 1em;
	}
	
	.job-info {
		font-size: 0.9rem;
		color: #4a5568;
	}
	
	.job-info i {
		font-size: 1.1rem;
	}
	
	.pagination {
		margin-bottom: 2rem;
	}
	
	.card-body .d-flex.align-items-center.mb-3 {
		margin-bottom: 1.5rem !important;
	}
	
	.card-link-wrapper {
		color: inherit;
		text-decoration: none;
	}
	
	.card-link-wrapper:hover {
		text-decoration: none;
		color: inherit;
	}
	
	.btn-outline-primary {
		border-radius: 20px;
		padding: 0.5rem 2rem;
		border-width: 2px;
		border-color: #e82454;    
		color: #e82454;
	}
	
	.btn-outline-primary:hover {
		background-color: #e82454;
		border-color: #e82454;
		color: white;             
	}
	
	/* Responsive Styles */
	@media (max-width: 991px) {
		.company-single {
			padding: 40px 0 20px;
		}
		
		.company-sidebar {
			padding-top: 1.5rem;
			margin-top: 1.5rem;
		}
	
		.company-logo {
			text-align: center;
			padding-right: 0;
			margin-bottom: 2rem;
		}
	
		.company-title {
			text-align: center;
		}
	
		.company-sidebar {
			padding-top: 2rem;
			margin-top: 2rem;
			border-top: 1px solid #eee;
		}
	
		.job-postings {
			padding: 40px 0;
		}
	
		.job-card {
			margin-bottom: 1rem;
		}
	
		.company-name {
			font-size: 1.25rem !important;
		}
	}
	</style>

@endsection

