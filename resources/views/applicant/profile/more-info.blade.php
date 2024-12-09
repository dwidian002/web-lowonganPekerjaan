@extends('applicant.layout.main')

@section('content')
<div class="profile-container">
    <div class="profile-wrapper">
        @include('applicant.profile.sidebar', ['applicantProfile' => $applicantProfile])

        <div class="profile-content-container">
            <main class="profile-content">

                @if(session('pesan'))
                    <div class="alert alert-{{ session('pesan')[0] }}">
                        {{ session('pesan')[0] == 'success' ? 'Success!' : 'Error!' }} 
                        {{ session('pesan')[1] }}
                    </div>
                @endif
                
                <section id="education" class="profile-section">
                    <div class="section-header">
                        <h2>Education History</h2>
                        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                            <i class="icofont-ui-add"></i> Add Education
                        </button>
                    </div>
                    
                    @if($applicantProfile->educations->isEmpty())
                        <div class="no-education-message">
                            <i class="fas fa-graduation-cap"></i>
                            <p>No education history added yet</p>
                        </div>
                    @else
                        <div class="education-timeline">
                            @foreach ($applicantProfile->educations as $education)
                                <div class="education-card">
                                    <div class="education-details">
                                        <div class="education-icon">
                                            <i class="icofont-graduate-alt"></i>
                                        </div>
                                        <h4 class="degree">{{ $education->degree }}</h4>
                                        <p class="institution">{{ $education->institution_name }}</p>
                                        <div class="education-period">
                                            <span class="start-year">{{ $education->starting_year }}</span>
                                            <span class="separator">-</span>
                                            <span class="end-year">{{ $education->finishing_year }}</span>
                                        </div>
                                        <div class="education-actions">
                                            <button class="btn-edit edit-education" 
                                                data-education-id="{{ $education->id }}"
                                                data-degree="{{ $education->degree }}"
                                                data-institution="{{ $education->institution_name }}"
                                                data-start="{{ $education->starting_year }}"
                                                data-end="{{ $education->finishing_year }}">
                                                <i class="icofont-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('education.delete', ['id' => $education->id]) }}"
                                                method="POST"
                                                class="delete-form">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn-delete">
                                                  <i class="icofont-trash"></i> Delete
                                              </button>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
        
                <section id="experience" class="profile-section">
                    <div class="section-header">
                        <h2>Experience History</h2>
                        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                            <i class="icofont-ui-add"></i> Add Experience
                        </button>
                    </div>
                    
                    @if($applicantProfile->experiences->isEmpty())
                        <div class="no-experience-message">
                            <i class="fas fa-briefcase"></i>
                            <p>No experience history added yet</p>
                        </div>
                    @else
                        <div class="education-timeline">
                            @foreach ($applicantProfile->experiences as $experience)
                                <div class="education-card">
                                    <div class="education-details">
                                        <div class="education-icon">
                                            <i class="icofont-briefcase"></i>
                                        </div>
                                        <h3 class="degree">{{ $experience->job_Title }}</h3>
                                        <p class="institution">{{ $experience->company_name }}</p>
                                        <div class="education-period">
                                            <span class="lama_bekerja">Worked for {{ $experience->lama_bekerja }}</span>
                                        </div>
                                        <div class="education-actions">
                                            <button class="btn-edit edit-experience" 
                                                data-experience-id="{{ $experience->id }}"
                                                data-title="{{ $experience->job_Title }}"
                                                data-company="{{ $experience->company_name }}"
                                                data-lama_bekerja="{{ $experience->lama_bekerja }}">
                                                <i class="icofont-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('experience.delete', ['id' => $experience->id]) }}"
                                                method="POST"
                                                class="delete-form">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn-delete">
                                                  <i class="icofont-trash"></i> Delete
                                              </button>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
        
                <section id="skills" class="profile-section">
                    <div class="section-header">
                        <h2>My Skills</h2>
                        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                            <i class="icofont-ui-add"></i> Add Skill
                        </button>
                    </div>
                    
                    @if($applicantProfile->skills->isEmpty())
                        <div class="no-skills-message">
                            <i class="fas fa-cogs"></i>
                            <p>No skills added yet</p>
                        </div>
                    @else
                        <div class="education-timeline">
                            @foreach($applicantProfile->skills as $skill)
                                <div class="education-card">
                                    <div class="education-details">
                                        <div class="education-icon">
                                            <i class="icofont-check-circled"></i>
                                        </div>
                                        <h3 class="degree">{{ $skill->name }}</h3>
                                        <div class="education-actions">
                                            <button class="btn-edit edit-skill" 
                                                data-skill-id="{{ $skill->id }}"
                                                data-skill-name="{{ $skill->name }}">
                                                <i class="icofont-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('skill.delete', ['id' => $skill->id]) }}"
                                                method="POST"
                                                class="delete-form">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn-delete">
                                                  <i class="icofont-trash"></i> Delete
                                              </button>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
                
                <div class="modal fade" id="addEducationModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Education</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{route('education.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Degree</label>
                                        <input type="text" name="degree" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Institution</label>
                                        <input type="text" name="institution_name" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Starting Year</label>
                                            <input type="number" name="starting_year" class="form-control" required>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Finishing Year</label>
                                            <input type="number" name="finishing_year" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Education</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editEducationModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Education</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editEducationForm" action="{{ route('education.update', ['id' => ':id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="education_id" id="editEducationId">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Degree</label>
                                        <input type="text" name="degree" id="editEducationdegree" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Institution</label>
                                        <input type="text" name="institution_name" id="editEducationInstitution" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Starting Year</label>
                                            <input type="number" name="starting_year" id="editEducationStartYear" class="form-control" required>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Finishing Year</label>
                                            <input type="number" name="finishing_year" id="editEducationEndYear" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Education</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addExperienceModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Experience</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{route('experience.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" name="job_Title" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company</label>
                                        <input type="text" name="company_name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Duration</label>
                                        <input type="text" name="lama_bekerja" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Experience</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editExperienceModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Experience</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editExperienceForm" action="{{ route('experience.update', ['id' => ':id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="experience_id" id="editExperienceId">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" name="job_Title" id="editExperienceTitle" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company</label>
                                        <input type="text" name="company_name" id="editExperienceCompany" class ="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Duration</label>
                                        <input type="text" name="lama_bekerja" id="editExperiencelama_bekerja" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Experience</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addSkillModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Skill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{route('skill.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" name="name" class="form-control" placeholder="Enter skill name" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Skill</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="editSkillModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Skill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editSkillForm" action="{{ route('skill.update', ['id' => ':id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="skill_id" id="editSkillId">
                                <div class="modal-body">
                                    <input type="text" name="name" id="editSkillInput" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Skill</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        $('.edit-education').on('click', function() {
            var educationId = $(this).data('education-id');
            var degree = $(this).data('degree');
            var institution = $(this).data('institution');
            var startYear = $(this).data('start');
            var endYear = $(this).data('end');

            $('#editEducationId').val(educationId);
            $('#editEducationdegree').val(degree);
            $('#editEducationInstitution').val(institution);
            $('#editEducationStartYear').val(startYear);
            $('#editEducationEndYear').val(endYear);

            $('#editEducationModal').modal('show');
        });

        $('.edit-experience').on('click', function() {
            var experienceId = $(this).data('experience-id');
            var title = $(this).data('title');
            var company = $(this).data('company');
            var lama_bekerja = $(this).data('lama_bekerja');

            $('#editExperienceId').val(experienceId);
            $('#editExperienceTitle').val(title);
            $('#editExperienceCompany').val(company);
            $('#editExperiencelama_bekerja').val(lama_bekerja);

            $('#editExperienceModal').modal('show');
        });

        $('.edit-skill').on('click', function() {
            var skillId = $(this).data('skill-id');
            var skillName = $(this).data('skill-name');

            $('#editSkillId').val(skillId);
            $('#editSkillInput').val(skillName);

            $('#editSkillModal').modal('show');
        });
    });
</script>

@endsection
