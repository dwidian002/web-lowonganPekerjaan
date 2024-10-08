<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['previous_status', 'new_status', 'changed_add', 'application_id'];

    public function application() {
        return $this->belongsTo(Application::class);
    }
}
