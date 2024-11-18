<?php

namespace App\Services;

use App\Models\EmailTemplate;
use App\Models\ApplicationNotification;
use App\Models\Application;
use App\Models\Log;
use App\Mail\ApplicationStatusChanged;
use App\Models\MasterLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ApplicationNotificationService
{
    /**
     * Schedule interview and send notification
     */
    public function scheduleInterview(Application $application, array $data)
    {
        return DB::transaction(function () use ($application, $data) {
            $previousStatus = $application->application_status;

            $application->update([
                'application_status' => 'interview'
            ]);

            Log::create([
                'previous_status' => $previousStatus,
                'new_status' => 'interview',
                'application_id' => $application->id,
                'changed_at' => now(),
            ]);

            $notification = $this->createNotification($application, 'interview', [
                'interview_date' => $data['interview_date'],
                'location' => $data['location'],
                'notes' => $data['notes'] ?? 'No additional notes provided',
            ]);

            $this->sendNotification($notification);

            MasterLog::create([
                'log_name' => 'Interview Scheduled',
                'is_send_email' => true,
                'application_id' => $application->id
            ]);

            return $notification;
        });
    }

    /**
     * Accept application and send notification
     */
    public function acceptApplication(Application $application, array $data)
    {
        return DB::transaction(function () use ($application, $data) {
            $previousStatus = $application->application_status;

            $application->update([
                'application_status' => 'hired'
            ]);

            Log::create([
                'previous_status' => $previousStatus,
                'new_status' => 'hired',
                'application_id' => $application->id,
                'changed_at' => now(),
            ]);

            $notification = $this->createNotification($application, 'accepted', [
                'start_date' => $data['start_date'],
                'additional_info' => $data['additional_info'] ?? 'No additional information provided',
            ]);

            $this->sendNotification($notification);

            MasterLog::create([
                'log_name' => 'Application Accepted',
                'is_send_email' => true,
                'application_id' => $application->id
            ]);

            return $notification;
        });
    }

    /**
     * Reject application and send notification
     */
    public function rejectApplication(Application $application, array $data)
    {
        return DB::transaction(function () use ($application, $data) {
            $previousStatus = $application->application_status;

            $application->update([
                'application_status' => 'rejected'
            ]);

            Log::create([
                'previous_status' => $previousStatus,
                'new_status' => 'rejected',
                'application_id' => $application->id,
                'changed_at' => now(),
            ]);

            $notification = $this->createNotification($application, 'rejected', [
                'rejection_reason' => $data['rejection_reason'],
            ]);

            $this->sendNotification($notification);

            MasterLog::create([
                'log_name' => 'Application Rejected',
                'is_send_email' => true,
                'application_id' => $application->id
            ]);

            return $notification;
        });
    }

    /**
     * Create a new notification record
     */
    private function createNotification($application, $status, $emailData = [])
    {
        $template = EmailTemplate::where('name', "{$status}_notification")->first();

        if (!$template) {
            throw new \Exception("Email template not found for status: {$status}");
        }

        return ApplicationNotification::create([
            'application_id' => $application->id,
            'email_template_id' => $template->id,
            'status' => $status,
            'email_data' => $emailData,
            'scheduled_at' => now()
        ]);
    }

    /**
     * Send notification email
     */

    /**
     * Replace placeholders in text with actual values
     * 
     * @param string $text Text containing placeholders
     * @param array $data Array of key-value pairs to replace placeholders
     * @return string
     */

    private function replacePlaceholders(string $text, array $data): string
    {
        foreach ($data as $key => $value) {
            $placeholder = '{{' . $key . '}}';
            $text = str_replace($placeholder, $value, $text);
        }

        return $text;
    }
    private function sendNotification(ApplicationNotification $notification)
    {
        $template = $notification->emailTemplate;
        $application = $notification->application;

        $application->load([
            'user.applicantProfile', 
            'jobPosting.companyProfile.location',
            'jobPosting.fieldOfWork', 
            'jobPosting.jobCategory'  
        ]);

        $user = $application->user;
        $applicantProfile = $user->applicantProfile;
        $jobPosting = $application->jobPosting;
        $companyProfile = $jobPosting->companyProfile;
        $location = $companyProfile->location;

        if (!$user || !$applicantProfile || !$jobPosting || !$companyProfile) {
            throw new \Exception("Required relationship data is missing");
        }

        $applicantName = $applicantProfile->name ?? 'Applicant';

        $emailData = $notification->email_data;

        if (isset($emailData['interview_date'])) {
            $emailData['interview_date'] = \Carbon\Carbon::parse($emailData['interview_date'])
                ->format('l, F j, Y \a\t g:i A');

            $notification->email_data = $emailData;
            $notification->save();
        }

        $salary = $jobPosting->sembunyikan_gaji ? 'Competitive' :
            'Rp ' . number_format($jobPosting->gaji, 0, ',', '.');

        $body = $this->replacePlaceholders($template->body, array_merge(
            $emailData,
            [
                'applicant_name' => $applicantName,
                'company_name' => $companyProfile->company_name,
                'position' => $jobPosting->position,
                'company_location' => $location->name ?? '',
                'company_website' => $companyProfile->website,
                'company_address' => $companyProfile->alamat_lengkap,
                'job_description' => $jobPosting->job_description,
                'requirements' => $jobPosting->requirements_desciption,
                'salary' => $salary,
                'field_of_work' => $jobPosting->fieldOfWork->name ?? '',
                'job_category' => $jobPosting->jobCategory->name ?? ''
            ]
        ));

        $subject = $this->replacePlaceholders($template->subject, [
            'position' => $jobPosting->position,
            'company_name' => $companyProfile->company_name
        ]);

        Mail::to($user->email)
            ->send(new ApplicationStatusChanged($subject, $body));

        $notification->update([
            'is_sent' => true,
            'sent_at' => now()
        ]);
    }
}
