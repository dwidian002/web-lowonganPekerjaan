@extends('layoutlogin.login')

@section('login')
<main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('image-path'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-3">Complete Your Applicant Profile</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Applicant Profile</h5>
                    </div>
                    @if(session()->has('pesan'))
                    <div class="alert alert-danger">
                        {{session()->get('pesan')}}
                    </div>
                    @endif
                    <form action="{{ route('exs.store')}}" method="POST">
                        @csrf

                        <!-- Education Section -->
                        <div class="card-body">
                            <h6>Last Education</h6>
                            <div id="education-container">
                                <div class="mb-3">
                                    <input type="hidden" name="profile_id" value="{{ $profile->id_Profile }}">
                                    <input type="text" name="education[0][degree]" class="form-control" placeholder="Degree" required>
                                    <input type="text" name="education[0][institution_name]" class="form-control mt-2" placeholder="Institution Name" required>
                                    <input type="year" name="education[0][starting_year]" class="form-control mt-2" placeholder="Starting Year" required>
                                    <input type="year" name="education[0][finishing_year]" class="form-control mt-2" placeholder="Finished Year" required>
                                </div>
                            </div>

                            <!-- Experience Section -->
                            <h6>Experience</h6>
                            <div id="experience-container">
                                <div class="mb-3">
                                    <input type="hidden" name="profile_id" value="{{ $profile->id_Profile }}">
                                    <input type="text" name="experience[0][job_Title]" class="form-control" placeholder="Job Title" required>
                                    <input type="text" name="experience[0][company_name]" class="form-control mt-2" placeholder="Company Name" required>
                                    <input type="text" name="experience[0][position]" class="form-control mt-2" placeholder="Position" required>
                                    <input type="text" name="experience[0][lama_bekerja]" class="form-control mt-2" placeholder="Duration" required>
                                </div>
                            </div>
                            <button type="button" id="add-experience" class="add-btn w-100 mb-3">
                                <i class="fa fa-plus icon"></i> Add Another Experience
                            </button>

                            <!-- Skills Section -->
                            <h6>Skills</h6>
                            <div id="skills-container">
                                <div class="mb-3">
                                    <input type="hidden" name="profile_id" value="{{ $profile->id_Profile }}">
                                    <input type="text" name="skills[0][name]" class="form-control" placeholder="Skill Name" required>
                                </div>
                            </div>
                            <button type="button" id="add-skill" class="add-btn w-100 mb-3">
                                <i class="fa fa-plus icon"></i> Add Another Skill</button>
                        </div>
                        <button type="submit" value="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Save Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Include JavaScript for adding dynamic fields -->
<script>
    let experienceIndex = 1;
    let skillIndex = 1;

    document.getElementById('add-experience').addEventListener('click', function() {
        const experienceContainer = document.getElementById('experience-container');
        const newExperience = `
            <div class="mb-3">
                <input type="text" name="experience[${experienceIndex}][job_Title]" class="form-control" placeholder="Job Title" required>
                <input type="text" name="experience[${experienceIndex}][company_name]" class="form-control mt-2" placeholder="Company Name" required>
                <input type="text" name="experience[${experienceIndex}][position]" class="form-control mt-2" placeholder="Position" required>
                <input type="text" name="experience[${experienceIndex}][lama_bekerja]" class="form-control mt-2" placeholder="Duration" required>
            </div>
        `;
        experienceContainer.insertAdjacentHTML('beforeend', newExperience);
        experienceIndex++;
    });

    document.getElementById('add-skill').addEventListener('click', function() {
        const skillsContainer = document.getElementById('skills-container');
        const newSkill = `
            <div class="mb-3">
                <input type="text" name="skills[${skillIndex}][name]" class="form-control" placeholder="Skill Name" required>
            </div>
        `;
        skillsContainer.insertAdjacentHTML('beforeend', newSkill);
        skillIndex++;
    });
</script>

<style>
    .add-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 15px;
        /* Decreased padding */
        font-size: 14px;
        /* Decreased font size */
        font-weight: bold;
        color: #0056b3;
        border: 2px solid #0056b3;
        border-radius: 10px;
        /* Reduced border-radius to match "Add Skill" button */
        background-color: white;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .add-btn .icon {
        font-size: 12px;
        /* Decreased icon size */
        margin-right: 5px;
        /* Reduced margin */
    }

    .add-btn:hover {
        background-color: #0056b3;
        color: white;
    }
</style>
@endsection