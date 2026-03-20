<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'logo', 'description', 'website',
        'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted(): void
    {
        static::creating(function (Client $c) {
            if (empty($c->slug)) $c->slug = Str::slug($c->name);
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }
}
