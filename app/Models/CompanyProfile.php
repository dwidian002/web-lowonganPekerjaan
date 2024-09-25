<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'profile_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['company_name', 'industry', 'tahun_berdiri','alamat', 'description', 'website', 'logo', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jobPostings() {
        return $this->hasMany(JobPosting::class);
    }
}

