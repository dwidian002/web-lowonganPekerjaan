<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = ['job_title', 'job_description', 'gaji', 'lokasi', 'status', 'sembunyikan_gaji', 'company_id'];

    public function companyProfile() {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function Location() {
        return $this->belongsToMany(Location::class);
    }

    public function jobCategories() {
        return $this->belongsToMany(JobCategory::class,);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
}
