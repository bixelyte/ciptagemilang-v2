<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'company', 'subject', 'message', 'is_read',
    ];

    protected $casts = ['is_read' => 'boolean'];

    public function scopeUnread($q) { return $q->where('is_read', false); }
}
