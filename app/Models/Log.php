<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'previous_status',
        'new_status',
        'changed_at',
        'application_id'
    ];

    protected $casts = [
        'changed_at' => 'datetime'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
