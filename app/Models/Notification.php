<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pelamar_id',
        'title',
        'message',
        'type',
        'is_read',
        'data'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array'
    ];

    // Relationship with User (admin who receives notification)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Pelamar (applicant who triggered notification)
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope for admin notifications
    public function scopeForAdmins($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('role', 'Admin');
        });
    }
}
