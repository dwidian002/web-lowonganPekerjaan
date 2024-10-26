<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'location_id',
        'industry_id',
        'type_company_id',
        'tahun_berdiri',
        'alamat_lengkap',
        'description',
        'website',
        'logo',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function typeCompany()
    {
        return $this->belongsTo(TypeCompany::class, 'type_company_id');
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
}
