<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'email_template_id',
        'status',
        'email_data',
        'is_sent',
        'scheduled_at',
        'sent_at'
    ];

    protected $casts = [
        'email_data' => 'array',
        'is_sent' => 'boolean',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function emailTemplate()
    {
        return $this->belongsTo(EmailTemplate::class);
    }
}
