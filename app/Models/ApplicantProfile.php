<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
{
    use HasFactory;

    protected $fillable = ['alamat', 'ttl', 'phone_number', 'experience', 'education', 'skills', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function education() {
        return $this->hasMany(Education::class);
    }

    public function skills() {
        return $this->hasMany(Skill::class);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
}

