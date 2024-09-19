<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLog extends Model
{
    use HasFactory;

    protected $fillable = ['log_name', 'is_send_email', 'application_id'];

    public function application() {
        return $this->belongsTo(Application::class);
    }
}
