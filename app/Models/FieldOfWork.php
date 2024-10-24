<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldOfWork extends Model
{
    protected $table = 'fields_of_work';
    protected $fillable = ['name'];

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
}
