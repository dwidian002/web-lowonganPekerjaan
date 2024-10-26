<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'location_id',
        'field_of_work_id',
        'company_profile_id',
        'job_category_id',
        'job_description',
        'requirements_desciption',
        'gaji',
        'status',
        'sembunyikan_gaji'
    ];

    public function companyProfile()
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function fieldOfWork()
    {
        return $this->belongsTo(FieldOfWork::class);
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
