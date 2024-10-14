<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }

    public function applicantProfiles()
    {
        return $this->hasMany(ApplicantProfile::class);
    }

    public function companyProfiles()
    {
        return $this->hasMany(CompanyProfile::class);
    }
}
