@extends('applicant.layout.main')
@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1 class="text-capitalize mb-5 text-lg">Lowongan Pekerjaan</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="section service-1">
    <div class="container">
        <div class="search-container mb-5">
            <div class="col-12">
                <form action="{{ route('job-postings.all') }}" method="GET" class="d-flex">
                    <div class="search-wrapper">
                        <div class="search-input-container">
                            <input type="text" name="search" class="search-input" placeholder="Cari posisi atau perusahaan">
                        </div>
                        <div class="select-container">
                            <select name="category" class="select-input">
                                <option value="">Semua Kategori</option>
                                @foreach($jobCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
                            <select name="bidang" class="select-input">
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

        <div class="row">
            @forelse($jobPostings as $jobPosting)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow job-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="company-logo mr-3">
                                @if ($jobPosting->companyProfile && $jobPosting->companyProfile->logo)
                                    <img src="{{ asset('storage/' . $jobPosting->companyProfile->logo) }}" 
                                         alt="{{ $jobPosting->companyProfile->company_name }}" 
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
                                <a href="{{ route('company.detail', $jobPosting->companyProfile->id) }}" class="company-name-link">
                                    <h5 class="company-name">{{ $jobPosting->companyProfile->company_name }}</h5>
                                </a>
                            </div>
                        </div>
                        
                        <a href="{{ route('job.detail', $jobPosting->id) }}" class="text-decoration-none text-dark">
                            <h4 class="job-title mb-3 job-title-link">{{ $jobPosting->position }}</h4>
        
                            <div class="job-tags mb-3">
                                <span class="badge {{ $jobPosting->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $jobPosting->status ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge badge-info mr-2">{{ $jobPosting->jobCategory->category_name }}</span>
                                <span class="badge badge-primary mr-2">{{ $jobPosting->fieldOfWork->name }}</span>
                            </div>
        
                            <div class="job-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="icofont-money mr-2 text-warning"></i>
                                    @if($jobPosting->sembunyikan_gaji)
                                        <span class="font-italic text-muted">(disembunyikan)</span>
                                    @else
                                        <span>Rp {{ number_format($jobPosting->gaji, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="icofont-location-pin mr-2 text-danger"></i>
                                    <span>{{ $jobPosting->location->name }}</span>
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

        @if($jobPostings->count() > 0)
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $jobPostings->links() }}
                </div>
            </div>
        @endif
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
</style>
@endsection