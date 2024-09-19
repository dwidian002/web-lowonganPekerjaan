<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['application_status', 'resume', 'applied_at', 'cover_letter', 'job_posting_id', 'user_id'];

    public function jobPosting() {
        return $this->belongsTo(JobPosting::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function logs() {
        return $this->hasMany(Log::class);
    }
}


