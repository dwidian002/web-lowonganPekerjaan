<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_profile_id',
        'degree',
        'institution_name',
        'starting_year',
        'finishing_year'
    ];

    public function applicantProfile()
    {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
