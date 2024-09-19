<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['job_title', 'company_name', 'lama_bekerja', 'applicant_profile_id'];

    public function applicantProfile() {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
