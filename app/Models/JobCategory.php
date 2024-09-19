<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function jobPostings() {
        return $this->belongsToMany(JobPosting::class, 'job_posting_job_category');
    }
}
