@extends('company.layout.main')

@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1 class="text-capitalize mb-5 text-lg">Application</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="section profile-section mt-n5 pb-5" style="background-color: #f7fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-lg shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success rounded-lg shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger rounded-lg shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card shadow-lg rounded-lg overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h2 class="text-2xl font-bold text-gray-800">Profile Applicant</h2>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="profile-container">
                            <div class="row">
                                <div class="col-md-4 text-center mb-md-0">
                                    <div class="profile-image-container">
                                        @if ($application->user->applicantProfile && $application->user->applicantProfile->foto)
                                            <img src="{{ asset('storage/' . $application->user->applicantProfile->foto) }}" 
                                                 alt="{{ $application->user->applicantProfile->name }}" 
                                                 class="profile-image">
                                        @else
                                            <img src="{{ asset('layout/assets/images/service/default-foto.jpg') }}" 
                                                 alt="Default Foto" 
                                                 class="profile-image">
                                        @endif
                                    </div>
                                    <div class="contact-info-block space-y-3 mt-0 p-4 bg-gray-50 rounded-xl">
                                        <a href="tel:{{ $application->user->applicantProfile->phone_number ?? '' }}" 
                                           class="contact-link phone group">
                                            <div class="contact-icon">
                                                <i class="icofont-phone"></i>
                                            </div>
                                            <span class="contact-text">
                                                {{ $application->user->applicantProfile->phone_number ?? '-' }}
                                            </span>
                                            <div class="contact-action">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                        </a>
                                        
                                        <a href="mailto:{{ $application->user->email ?? '' }}" 
                                           class="contact-link email group">
                                            <div class="contact-icon">
                                                <i class="icofont-email"></i>
                                            </div>
                                            <span class="contact-text">
                                                {{ $application->user->email ?? '-' }}
                                            </span>
                                            <div class="contact-action">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="profile-details">
                                        <div class="detail-row">
                                          <div class="detail-label"><strong>Name:</strong></div>
                                          <div class="detail-value">{{ $application->user->applicantProfile->name ?? '-' }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label"><strong>Apply For:</strong></div>
                                            <div class="detail-value">{{ $application->jobPosting->position ?? '-' }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-label"><strong>Applied at:</strong></div>
                                            <div class="detail-value">{{ $application->user->applicantProfile->created_at ? $application->user->applicantProfile->created_at->format('d M Y') : '-' }}</div>
                                        </div>
                                        <div class="detail-row">
                                          <div class="detail-label"><strong>Gender:</strong></div>
                                          <div class="detail-value">{{ $application->user->applicantProfile->gender ?? '-' }}</div>
                                        </div>
                                        <div class="detail-row">
                                          <div class="detail-label"><strong>Address:</strong></div>
                                          <div class="detail-value">{{ $application->user->applicantProfile->alamat_lengkap ?? '-' }}</div>
                                        </div>
                                        <div class="detail-row">
                                          <div class="detail-label"><strong>About:</strong></div>
                                          <div class="detail-value">{{ $application->user->applicantProfile->about_me ?? '-' }}</div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card shadow-lg rounded-lg h-100">
                            <div class="card-body p-4">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-file-pdf text-blue-600 mr-2"></i> Resume
                                </h3>
                                <div class="document-preview">
                                    @if($application->resume)
                                        <a href="{{ asset('storage/' . $application->resume) }}" 
                                           target="_blank" 
                                           class="btn btn-primary btn-block">
                                            <i class="fas fa-download mr-2"></i> Download Resume
                                        </a>
                                    @else
                                        <div class="text-center text-gray-500 py-4">
                                            <i class="fas fa-file-upload fa-2x mb-2"></i>
                                            <p>No resume uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-lg rounded-lg h-100">
                            <div class="card-body p-4">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-briefcase text-blue-600 mr-2"></i> Portfolio
                                </h3>
                                <div class="portfolio-preview">
                                    @if($application->portofolio)
                                        <a href="{{ $application->portofolio }}" 
                                           target="_blank" 
                                           class="btn btn-outline-primary btn-block">
                                            <i class="fas fa-external-link-alt mr-2"></i> View Portfolio
                                        </a>
                                    @else
                                        <div class="text-center text-gray-500 py-4">
                                            <i class="fas fa-link fa-2x mb-2"></i>
                                            <p>No portfolio link provided</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-lg rounded-lg overflow-hidden mt-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                      <h2 class="text-2xl font-bold text-gray-800">More Information</h2>
                    </div>
                  
                    <div class="accordion">
                      <div class="accordion-item">
                        <div class="accordion-header">
                          <h6 class="text-xl font-semibold text-gray-800 mb-3">
                            <i class="fas fa-graduation-cap text-blue-600 mr-2"></i> Last Education
                          </h6>
                          <button class="accordion-toggle">
                            <i class="icofont-circled-down accordion-icon"></i>
                          </button>
                        </div>
                        <div class="accordion-content">
                          <div class="detail-row">
                            <div class="detail-label">Degree</div>
                            <div class="detail-value">{{ $application->user->applicantProfile->education->degree ?? '-' }}</div>
                          </div>
                          <div class="detail-row">
                            <div class="detail-label">Institution</div>
                            <div class="detail-value">{{ $application->user->applicantProfile->education->institution_name ?? '-' }}</div>
                          </div>
                          <div class="detail-row">
                            <div class="detail-label">Duration</div>
                            <div class="detail-value">
                              {{ $application->user->applicantProfile->education->starting_year ?? '-' }} -
                              {{ $application->user->applicantProfile->education->finishing_year ?? '-' }}
                            </div>
                          </div>
                        </div>
                      </div>
                  
                      <div class="accordion-item">
                        <div class="accordion-header">
                          <h6 class="text-xl font-semibold text-gray-800 mb-3">
                            <i class="fas fa-briefcase"></i> Experiences
                          </h6>
                          <button class="accordion-toggle">
                            <i class="icofont-circled-down accordion-icon"></i>
                          </button>
                        </div>
                        <div class="accordion-content">
                          @if($application->user->applicantProfile->experiences->count() > 0)
                            @foreach($application->user->applicantProfile->experiences as $experience)
                              <div class="experience-card">
                                <div class="experience-content">
                                  <div class="experience-item">
                                    <div class="item-label">Job Title</div>
                                    <div class="item-value">{{ $experience->job_Title ?? '-' }}</div>
                                  </div>
                                  <div class="experience-item">
                                    <div class="item-label">Company</div>
                                    <div class="item-value">{{ $experience->company_name ?? '-' }}</div>
                                  </div>
                                  <div class="experience-item">
                                    <div class="item-label">Position</div>
                                    <div class="item-value">{{ $experience->position ?? '-' }}</div>
                                  </div>
                                  <div class="experience-item">
                                    <div class="item-label">Duration</div>
                                    <div class="item-value">{{ $experience->lama_bekerja ?? '-' }}</div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          @else
                            <div class="text-gray-500">No experience listed</div>
                          @endif
                        </div>
                      </div>
                  
                      <div class="accordion-item">
                        <div class="accordion-header">
                          <h6 class="text-xl font-semibold text-gray-800 mb-3">
                            <i class="fas fa-tools text-blue-600 mr-2"></i> Skills
                          </h6>
                          <button class="accordion-toggle">
                            <i class="icofont-circled-down accordion-icon"></i>
                          </button>
                        </div>
                        <div class="accordion-content">
                          <div class="flex flex-wrap gap-2">
                            @if($application->user->applicantProfile->skills->count() > 0)
                              @foreach($application->user->applicantProfile->skills as $skill)
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">
                                  <i class="fas fa-check-circle mr-2 text-success"></i>
                                  {{ $skill->name }}
                                </span>
                              @endforeach
                            @else
                              <p class="text-gray-500">No skills listed</p>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card shadow-lg rounded-lg overflow-hidden mt-4">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-center">
                        <a href="{{route ('job-posting.show', $application->jobPosting->id)}}" class="btn btn-outline-primary mr-3">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                        @if($application->application_status === 'applied' || $application->application_status === 'in_review')
                            <button class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#interviewModal" data-application-id="{{ $application->id }}">
                                <i class="fas fa-comments mr-2"></i> Interview
                            </button>
                        @endif
                        @if($application->application_status === 'applied' || $application->application_status === 'in_review' || $application->application_status === 'interview')
                            <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#acceptModal" data-application-id="{{ $application->id }}">
                                <i class="fas fa-check-circle mr-2"></i> Accept
                            </button>
                            <button class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#rejectModal" data-application-id="{{ $application->id }}">
                                <i class="fas fa-times-circle mr-2"></i> Reject
                            </button>
                        @endif
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="interviewModal" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="interviewModalLabel">Schedule Interview</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="interviewForm" action="" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="interview_date" class="form-label">Interview Date and Time</label>
              <input type="datetime-local" class="form-control" id="interview_date" name="interview_date" required>
            </div>
            
            <div class="mb-3">
              <label for="location" class="form-label">Interview Location</label>
              <input type="text" class="form-control" id="location" name="location" required>
            </div>
  
            <div class="mb-3">
              <label for="interview_type" class="form-label">Interview Type</label>
              <select class="form-control" id="interview_type" name="interview_type" required>
                <option value="online">Online Interview</option>
                <option value="offline">Offline Interview</option>
              </select>
            </div>
            
            <div class="mb-3">
              <label for="notes" class="form-label">Additional Notes</label>
              <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send Mail Intervew</button>
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="acceptModalLabel">Accept Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="acceptForm" action="" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="start_date" class="form-label">Start Date</label>
              <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            
            <div class="mb-3">
              <label for="salary" class="form-label">Offered Salary</label>
              <input type="number" class="form-control" id="salary" name="salary" required>
            </div>
            
            <div class="mb-3">
              <label for="additional_info" class="form-label">Additional Information</label>
              <textarea class="form-control" id="additional_info" name="additional_info" rows="3" 
                placeholder="Include any additional details about the job offer, benefits, or next steps"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Accept Application</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  
 <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Reject Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="rejectForm" action="" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="rejection_reason" class="form-label">Reason for Rejection</label>
              <select class="form-control" id="rejection_reason" name="rejection_reason" required>
                <option value="">Select a reason</option>
                <option value="not_qualified">Not Qualified for Position</option>
                <option value="experience_mismatch">Experience Does Not Match Requirements</option>
                <option value="skills_mismatch">Skills Do Not Match Requirements</option>
                <option value="position_filled">Position Has Been Filled</option>
                <option value="other">Other</option>
              </select>
            </div>
            
            <div class="mb-3" id="other_reason_container" style="display: none;">
              <label for="other_reason" class="form-label">Specify Other Reason</label>
              <textarea class="form-control" id="other_reason" name="other_reason" rows="2"></textarea>
            </div>
            
            <div class="mb-3">
              <label for="feedback" class="form-label">Feedback for Candidate (Optional)</label>
              <textarea class="form-control" id="feedback" name="feedback" rows="3" 
                placeholder="Provide constructive feedback to help the candidate improve"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Reject Application</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const tomorrow = new Date();
          tomorrow.setDate(tomorrow.getDate() + 1);
          const tomorrowString = tomorrow.toISOString().split('T')[0];
          
          const interviewDateInput = document.getElementById('interview_date');
          const startDateInput = document.getElementById('start_date');
          
          if (interviewDateInput) {
              interviewDateInput.min = tomorrowString;
          }
          
          if (startDateInput) {
              startDateInput.min = tomorrowString;
          }
  
          const modals = {
              interview: {
                  element: document.getElementById('interviewModal'),
                  form: document.getElementById('interviewForm')
              },
              accept: {
                  element: document.getElementById('acceptModal'),
                  form: document.getElementById('acceptForm')
              },
              reject: {
                  element: document.getElementById('rejectModal'),
                  form: document.getElementById('rejectForm')
              }
          };
  
          ['interview', 'accept', 'reject'].forEach(modalType => {
              const modal = modals[modalType];
              if (modal.element) {
                  modal.element.addEventListener('show.bs.modal', function(event) {
                      const button = event.relatedTarget;
                      const applicationId = button.getAttribute('data-application-id');
                      const action = modalType === 'interview' ? 'schedule-interview' : modalType;
                      modal.form.action = `/applications/${applicationId}/${action}`;
                  });
              }
          });
  
          const rejectionReason = document.getElementById('rejection_reason');
          const otherReasonContainer = document.getElementById('other_reason_container');
          
          if (rejectionReason && otherReasonContainer) {
              rejectionReason.addEventListener('change', function() {
                  otherReasonContainer.style.display = this.value === 'other' ? 'block' : 'none';
              });
          }
  
          const initializeAccordions = () => {
              document.querySelectorAll('.accordion-toggle').forEach(button => {
                  button.addEventListener('click', function(e) {
                      e.preventDefault();
                      const accordionItem = this.closest('.accordion-item');
                      const content = accordionItem.querySelector('.accordion-content');
                      const icon = this.querySelector('.accordion-icon');
                      
                      accordionItem.classList.toggle('active');
                      
                      icon.classList.toggle('icofont-circled-down');
                      icon.classList.toggle('icofont-circled-up');
                      
                      if (content.style.maxHeight) {
                          content.style.maxHeight = null;
                          content.style.display = 'none';
                      } else {
                          content.style.display = 'block';
                          content.style.maxHeight = content.scrollHeight + "px";
                      }
                  });
              });
          };
  
          initializeAccordions();
      });
  </script>


<style>

    .btn {
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .centered-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1rem;
    }

    .centered-buttons a {
        margin: 0 0.5rem;
    }

    .profile-details {
    flex-basis: 50%;
    margin-left: 20px;
    }

    .detail-row {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #f0f0f0;
    }

    .detail-label {
    flex-basis: 30%;
    font-weight: bold;
    color: #333;
    }

    .detail-value {
    flex-basis: 70%;
    color: #666;
    }

    .accordion {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 16px;
    margin-bottom: 16px;
    }

    .accordion-item {
    border-bottom: 1px solid #ccc;
    padding: 16px 0;
    }

    .accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    }

    .accordion-toggle {
    background-color: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    }

    .accordion-icon {
    transition: transform 0.3s;
    }

    .accordion-item.active .accordion-icon {
    transform: rotate(180deg);
    }

    .accordion-content {
    margin-top: 16px;
    display: none;
    }

    .experience-card {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 16px;
    margin-bottom: 16px;
    }

    .experience-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 16px;
    }

    .experience-item {
    display: flex;
    flex-direction: column;
    }

    .item-label {
    font-weight: bold;
    color: #6b7280;
    }

    .interactive-section {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 16px;
    margin-bottom: 16px;
    }

    .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .toggle-btn {
    color: blue;
    text-decoration: underline;
    cursor: pointer;
    }

    .section-content {
    margin-top: 16px;
    }

    .experience-card {
    background-color: #f9fafb;
    border-radius: 4px;
    padding: 12px;
    margin-bottom: 12px;
    }

    .experience-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 4px;
    }

    .item-label {
    font-weight: bold;
    color: #6b7280;
    }

    :root {
        --primary-color: #2b6cb0;
        --secondary-color: #1a365d;
        --accent-color: #4299e1;
        --text-primary: #2d3748;
        --text-secondary: #4a5568;
        --bg-light: #f7fafc;
        --transition-speed: 0.3s;
    }

    .page-title {
        position: relative;
        padding: 80px 0;
        margin-bottom: -50px;
    }

    .profile-section {
        background-color: var(--bg-light);
    }

    .card {
        background: white;
        border: none;
        transition: transform var(--transition-speed);
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
    }

    .profile-image {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: 4px solid white;
        transition: transform var(--transition-speed);
    }

    .profile-image:hover {
        transform: scale(1.05);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all var(--transition-speed);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .shadow-lg {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .alert {
        border: none;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .experiences-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .experience-card {
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 1.5rem;
        background: white;
    }

    .experience-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .experience-item {
        margin-bottom: 0.5rem;
    }

    .item-label {
        color: #718096;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .item-value {
        color: #2d3748;
        font-weight: 500;
    }

    .contact-info-block {
        transition: all 0.3s ease;
    }

    .contact-link {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        text-decoration: none;
        background: white;
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .contact-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .contact-link.phone:hover {
        background: linear-gradient(145deg, #dcfce7, #bbf7d0);
        border-color: #86efac;
    }

    .contact-link.email:hover {
        background: linear-gradient(145deg, #dbeafe, #bfdbfe);
        border-color: #93c5fd;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        margin-right: 1rem;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }

    .phone .contact-icon {
        background-color: #dcfce7;
        color: #16a34a;
    }

    .email .contact-icon {
        background-color: #dbeafe;
        color: #2563eb;
    }

    .contact-text {
        flex: 1;
        color: var(--text-primary);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .contact-action {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f3f4f6;
        color: #6b7280;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s ease;
    }

    .contact-link:hover .contact-action {
        opacity: 1;
        transform: translateX(0);
    }

    .phone:hover .contact-action {
        background-color: #86efac;
        color: #16a34a;
    }

    .email:hover .contact-action {
        background-color: #93c5fd;
        color: #2563eb;
    }

    @media (max-width: 768px) {
        .contact-link {
            padding: 0.75rem;
        }
        
        .contact-icon {
            width: 32px;
            height: 32px;
            font-size: 1rem;
        }
        
        .contact-action {
            width: 28px;
            height: 28px;
        }
    }

    /* Animation for hover effect */
    @keyframes pulseScale {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .contact-link:hover .contact-icon {
        animation: pulseScale 1s infinite;
    }

    .contact-info-block {
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .contact-link {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        background: white;
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .contact-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
    }

    .contact-icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        margin-right: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .contact-text {
        flex: 1;
        color: var(--text-primary);
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .contact-action {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f3f4f6;
        color: #6b7280;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s ease;
        font-size: 0.75rem;
    }

    @media (max-width: 768px) {
        .contact-link {
            padding: 0.375rem;
        }
        
        .contact-icon {
            width: 24px;
            height: 24px;
            font-size: 0.75rem;
        }
        
        .contact-action {
            width: 20px;
            height: 20px;
        }
        
        .contact-text {
            font-size: 0.8125rem;
        }
    }


    @media (max-width: 768px) {

        .experiences-container {
            grid-template-columns: repeat(1, 1fr);
            max-width: 800px;
            margin: 0 auto;
        }
        .profile-image {
            width: 150px;
            height: 150px;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeInUp 0.5s ease-out;
    }
</style>
@endsection