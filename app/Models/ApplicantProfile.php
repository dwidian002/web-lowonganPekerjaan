<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_Profile';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name', 'alamat', 'tanggal_lahir', 'phone_number', 'resume', 'user_id'];

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
