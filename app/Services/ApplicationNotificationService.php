<?php

namespace App\Services;

use App\Models\EmailTemplate;
use App\Models\ApplicationNotification;
use App\Models\Application;
use App\Models\Log;
use App\Mail\ApplicationStatusChanged;
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

            $application->update(['application_status' => 'interview']);

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

            $application->update(['application_status' => 'hired']);

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

            $application->update(['application_status' => 'rejected']);

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
    private function sendNotification(ApplicationNotification $notification)
    {
        $template = $notification->emailTemplate;
        $application = $notification->application;
        $user = $application->user;
        $jobPosting = $application->jobPosting;
        $companyProfile = $jobPosting->companyProfile;

        if (!$user || !$jobPosting || !$companyProfile) {
            throw new \Exception("Required relationship data is missing");
        }

        $applicantName = $user->name ?? 'Applicant';

        $emailData = $notification->email_data;

        if (isset($emailData['interview_date'])) {
            $emailData['interview_date'] = \Carbon\Carbon::parse($emailData['interview_date'])
                ->format('l, F j, Y \a\t g:i A');

            $notification->email_data = $emailData;
            $notification->save();
        }

        $body = $this->replacePlaceholders($template->body, array_merge(
            $emailData,
            [
                'applicant_name' => $applicantName,
                'company_name' => $companyProfile->name,
                'position' => $jobPosting->position
            ]
        ));

        $subject = $this->replacePlaceholders($template->subject, [
            'position' => $jobPosting->position,
            'company_name' => $companyProfile->name
        ]);

        Mail::to($user->email)
            ->send(new ApplicationStatusChanged($subject, $body));

        $notification->update([
            'is_sent' => true,
            'sent_at' => now()
        ]);
    }

    /**
     * Replace placeholder text with actual values
     */
    private function replacePlaceholders($text, $data)
    {
        foreach ($data as $key => $value) {
            $text = str_replace("{{" . $key . "}}", $value ?? '', $text);
        }

        return $text;
    }
}
