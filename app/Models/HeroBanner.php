<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroBanner extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'highlight_text', 'description', 'badge_text', 'cta_primary_text', 'cta_secondary_text'];

    protected $fillable = [
        'title', 'highlight_text', 'description', 'image',
        'badge_text', 'cta_primary_text', 'cta_primary_url',
        'cta_secondary_text', 'cta_secondary_url',
        'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }
}
