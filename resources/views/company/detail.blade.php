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
            <!-- Company Logo -->
            <div class="col-lg-3">
                <div class="company-logo">
                    @if ($companies->logo)
                        <img src="{{ asset('storage/' . $companies->logo) }}" alt="{{ $companies->company_name }}" class="logo-img">
                    @else
                        <img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" alt="Default Logo" class="logo-img">
                    @endif
                </div>
            </div>

            <!-- Main Content -->
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

            <!-- Sidebar -->
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

<section class="section doctor-skills">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h2>Job Posted</h2>
				<div class="divider my-4"></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In architecto voluptatem alias, aspernatur voluptatibus corporis quisquam? Consequuntur, ad, doloribus, doloremque voluptatem at consectetur natus eum ipsam dolorum iste laudantium tenetur.</p>
			</div>
		</div>
	</div>
</section>


<style>
/* Company Logo */
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

/* Company Header */
.company-title {
    font-size: 2.5rem;
    color: #223a66;
    font-weight: 600;
    margin-bottom: 2rem;
}

/* Content Sections */
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

/* Sidebar */
.company-sidebar {
    padding-top: 3.7rem; /* Aligns with the description section */
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
    color: #223a66;
}

.sidebar-item a {
    color: #6c757d;
    text-decoration: none;
    word-break: break-all;
}

.sidebar-item a:hover {
    color: #223a66;
}

/* Responsive adjustments */
@media (max-width: 991px) {
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
}
</style>

@endsection

