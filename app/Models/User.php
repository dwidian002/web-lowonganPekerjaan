<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name', 'email', 'password', 'role', 'remember_token'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    public function applicantProfile() {
        return $this->hasOne(ApplicantProfile::class);
    }

    public function companyProfile() {
        return $this->hasOne(CompanyProfile::class);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
}