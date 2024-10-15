<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'tanggal_lahir', 'alamat_lengkap', 'phone_number', 'resume'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function education()
    {
        return $this->hasOne(Education::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
