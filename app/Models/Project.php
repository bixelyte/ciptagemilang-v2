<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'scope', 'description', 'location'];

    protected $fillable = [
        'title', 'slug', 'location', 'year', 'image', 'scope',
        'description', 'client_id', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $p) {
            if (empty($p->slug)) $p->slug = Str::slug($p->title . '-' . $p->year);
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable')->orderBy('sort_order');
    }
}
