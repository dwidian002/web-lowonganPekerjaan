@extends('applicant.layout.main')
@section('content')

<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1 class="text-capitalize mb-5 text-lg">Company Partner</h1>
          </div>
        </div>
      </div>
    </div>
</section>
  
<section class="section service-1">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="search-container mb-5">
            <div class="col-12">
                <form action="{{ route('list.company') }}" method="GET" class="d-flex">
                    <div class="search-wrapper">
                        <div class="search-input-container">
                            <input type="text" name="search" class="search-input" 
                                   placeholder="Search Companies" 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="select-container">
                            <select name="lokasi" class="select-input">
                                <option value="">Pilih Lokasi</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}"
                                            {{ request('lokasi') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-container">
                            <select name="industry" class="select-input">
                                <option value="">Pilih Industry</option>
                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}"
                                            {{ request('industry') == $industry->id ? 'selected' : '' }}>
                                        {{ $industry->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-main-2 btn-icon btn-round-full">SEARCH</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($companies as $company)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow job-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-logo mr-3">
                                    <a href="{{ route('company.detail', $company->id) }}">
                                    @if ($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->company_name }}" 
                                             class="rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('layout/assets/images/service/default-logo.jpg') }}" 
                                             alt="Default Logo" 
                                             class="rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('company.detail', $company->id) }}" class="company-name-link">
                                        <h5 class="company-name">{{ $company->company_name }}</h5>
                                    </a>
                                </div>
                            </div>

                            <div class="job-tags mb-3">
                                <span class="badge badge-info mr-2">{{ $company->typeCompany->name }}</span>
                                <span class="badge badge-success mr-2">Founded In {{ $company->tahun_berdiri }}</span>
                            </div>

                            <div class="job-info">
                                <div class="d-flex align-items-center">
                                    <i class="icofont-industries-2 mr-2 text-warning"></i>
                                    <span> <strong>Industry :  </strong> {{ $company->industry->name }}</span>
                                </div>
                            </div>
                            <div class="job-info">
                                <div class="d-flex align-items-center">
                                    <i class="icofont-location-pin mr-2 text-danger"></i>
                                    <span> <strong>Location :  </strong> {{ $company->location->name }}</span>
                                </div>
                            </div>
                            <div class="job-info">
                                <div class="d-flex align-items-center">
                                    <i class="icofont-web mr-2 text-secondary"></i>
                                    <span><a href="{{ $company->website }}" target="_blank">{{ Str::limit($company->website, 30) }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        <h4>Company tidak ditemukan</h4>
                        <p>Silahkan coba pencarian dengan kata kunci lain atau ubah filter pencarian Anda.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

  <style>

.search-wrapper {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .search-input-container,
    .select-container {
        margin-right: 60px;
        flex-grow: 1;
    }
    
    .search-input,
    .select-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }
    
    .search-input:focus,
    .select-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    
    .btn-primary {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
    }
    
    @media (max-width: 768px) {
        .search-wrapper {
            flex-direction: column;
        }
    
        .search-input-container,
        .select-container {
            width: 100%;
            margin-right: 0;
            margin-bottom: 10px;
        }
    }



    /* job */
    .job-card {
        transition: transform 0.2s ease-in-out;
        border-radius: 12px;
    }
    
    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .company-logo {
        display: flex;
        align-items: center;
    }
    
    .company-logo img {
        width: 70px !important;  
        height: 70px !important; 
        border: 1px solid #edf2f7;
        object-fit: cover;
    }
    
    .company-name {
        color: #333;
        font-size: 1.5rem !important; 
        font-weight: 600;
        line-height: 1.2;
        margin-bottom: 0;
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
    
    .btn-outline-primary {
        border-radius: 20px;
        padding: 0.5rem 2rem;
        border-width: 2px;
    }
    
    .pagination {
        margin-bottom: 2rem;
    }
    
    .card-body .d-flex.align-items-center.mb-3 {
        margin-bottom: 1.5rem !important;
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
    </style>

@endsection