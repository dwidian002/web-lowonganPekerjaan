<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    protected $fillable = ['id_Profile','name', 'applicant_profile_id'];

    public function applicantProfile() {
        return $this->belongsTo(ApplicantProfile::class);
    }
}

