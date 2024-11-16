<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            [
                'name' => 'interview_notification',
                'subject' => 'Interview Invitation - {{position}} Position at {{company_name}}',
                'body' => '
                    <p>Dear {{applicant_name}},</p>
                    
                    <p>We are pleased to invite you for an interview for the {{position}} position at {{company_name}}.</p>
                    
                    <p>Interview Details:</p>
                    <ul>
                        <li>Date and Time: {{interview_date}}</li>
                        <li>Location: {{location}}</li>
                    </ul>
                    
                    <p>Additional Notes:</p>
                    <p>{{notes}}</p>
                    
                    <p>Please confirm your attendance by replying to this email.</p>
                    
                    <p>Best regards,<br>
                    {{company_name}} Recruitment Team</p>'
            ],
            [
                'name' => 'accepted_notification',
                'subject' => 'Congratulations! Job Offer for {{position}} at {{company_name}}',
                'body' => '
                    <p>Dear {{applicant_name}},</p>
                    
                    <p>Congratulations! We are delighted to offer you the position of {{position}} at {{company_name}}.</p>
                    
                    <p>Details:</p>
                    <ul>
                        <li>Start Date: {{start_date}}</li>
                    </ul>
                    
                    <p>Additional Information:</p>
                    <p>{{additional_info}}</p>
                    
                    <p>Please confirm your acceptance by replying to this email.</p>
                    
                    <p>Welcome to the team!</p>
                    
                    <p>Best regards,<br>
                    {{company_name}} HR Team</p>'
            ],
            [
                'name' => 'rejected_notification',
                'subject' => 'Application Status Update - {{position}} at {{company_name}}',
                'body' => '
                    <p>Dear {{applicant_name}},</p>
                    
                    <p>Thank you for your interest in the {{position}} position at {{company_name}} and for taking the time to go through our recruitment process.</p>
                    
                    <p>After careful consideration, we regret to inform you that we have decided to move forward with other candidates whose qualifications more closely match our current needs.</p>
                    
                    <p>Reason:</p>
                    <p>{{rejection_reason}}</p>
                    
                    <p>We appreciate your interest in {{company_name}} and wish you the best in your future endeavors.</p>
                    
                    <p>Best regards,<br>
                    {{company_name}} Recruitment Team</p>'
            ]
        ];

        foreach ($templates as $template) {
            EmailTemplate::create($template);
        }
    }
}