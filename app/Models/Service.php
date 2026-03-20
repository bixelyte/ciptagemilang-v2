<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'short_description', 'description'];

    protected $fillable = [
        'title', 'slug', 'icon', 'short_description', 'description',
        'image', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted(): void
    {
        static::creating(function (Service $s) {
            if (empty($s->slug)) $s->slug = Str::slug($s->title);
        });
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }
}
