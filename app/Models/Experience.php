<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience';

    protected $fillable = ['applicant_profile_id', 'job_Title', 'company_name','position', 'lama_bekerja'];

    public function applicantProfile() {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
