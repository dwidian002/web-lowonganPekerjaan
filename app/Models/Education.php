<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['degree', 'institution_name', 'starting_year', 'finished_year', 'applicant_profile_id'];

    public function applicantProfile() {
        return $this->belongsTo(ApplicantProfile::class);
    }
}

