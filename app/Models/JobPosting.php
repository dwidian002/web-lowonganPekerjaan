<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = ['position', 'location_id', 'company_profile_id', 'job_category_id', 'job_description', 'requirements_desciption', 'gaji','status','sembunyikan_gaji'];

    public function companyProfile() {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function Location() {
        return $this->belongsToMany(Location::class);
    }

    public function FieldOfWork() {
        return $this->belongsToMany(FieldOfWork::class);
    }

    public function jobCategories() {
        return $this->belongsToMany(JobCategory::class,);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
}
