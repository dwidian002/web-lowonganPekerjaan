@extends('applicant.layout.main')
@section('content')

<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">Form Apply</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section job-posting-form mt-n5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="doctor-details mb-3 mt-0 mt-lg-0">
                    <h2 class="text-md">Informasi Anda</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="profile-section mb-4">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    @if ($applicantProfile && $applicantProfile->foto)
                                        <img src="{{ asset('storage/' . $applicantProfile->foto) }}" 
                                             alt="{{ $applicantProfile->name }}" 
                                             class="rounded"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="border rounded p-3" style="width: 100px; height: 100px;">
                                            <span class="text-muted">FOTO</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col">
                                    <h5 class="mb-1">{{ $applicantProfile->name ?? '{nama}' }}</h5>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-outline-primary btn-sm px-2 py-1">Show Profile</a>
                                    </div>
                                    <div class="text-success mt-2">
                                        <small><i class="fas fa-check-circle mr-1"></i> Pastikan data profile anda sudah benar!</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('store.apply') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="job_posting_id" value="{{ $jobPosting->id }}">

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Resume</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icofont-ui-file"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="custom-file-input @error('resume') is-invalid @enderror" 
                                           id="resume" name="resume" accept=".pdf,.doc,.docx" required hidden>
                                    <label for="resume" class="form-control text-truncate" style="cursor: pointer;">
                                        Pilih file
                                    </label>
                                    <div class="input-group-append">
                                        <label for="resume" class="input-group-text" style="cursor: pointer;">
                                            Browse
                                        </label>
                                    </div>
                                </div>
                                @error('resume')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: PDF, DOC, DOCX. Max: 2MB</small>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold d-block mb-2">Portofolio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icofont-link"></i>
                                        </span>
                                    </div>
                                    <input type="url" class="form-control @error('portofolio') is-invalid @enderror" 
                                           id="portofolio" name="portofolio" 
                                           placeholder="Enter portfolio URL" required
                                           value="{{ old('portofolio') }}">
                                </div>
                                @error('portofolio')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Cover Letter</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icofont-ui-file"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="custom-file-input @error('cover_letter') is-invalid @enderror" 
                                           id="cover_letter" name="cover_letter" accept=".pdf,.doc,.docx" required hidden>
                                    <label for="cover_letter" class="form-control text-truncate" style="cursor: pointer;">
                                        Pilih file
                                    </label>
                                    <div class="input-group-append">
                                        <label for="cover_letter" class="input-group-text" style="cursor: pointer;">
                                            Browse
                                        </label>
                                    </div>
                                </div>
                                @error('cover_letter')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: PDF, DOC, DOCX. Max: 2MB</small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            if (this.files && this.files[0]) {
                let fileName = this.files[0].name;
                let fileSize = this.files[0].size / 1024 / 1024; // Convert to MB
                let inputId = $(this).attr('id');
                
                if (fileSize > 2) { 
                    alert('Ukuran file tidak boleh lebih dari 2MB');
                    $(this).val(''); 
                    $(`label[for="${inputId}"]`).text('Pilih file');
                } else {
                    // Update both the form-control label and input-group-text
                    $(`label[for="${inputId}"].form-control`).text(fileName);
                    $(`label[for="${inputId}"].input-group-text`).text('Browse');
                }
            }
        });
    });
</script>
@endpush

<style>
.custom-file-input {
    cursor: pointer;
}

.form-control.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.input-group label.form-control {
    margin-bottom: 0;
}

.input-group label.form-control.text-truncate {
    background-color: #fff;
    cursor: pointer;
}
</style>
@endsection