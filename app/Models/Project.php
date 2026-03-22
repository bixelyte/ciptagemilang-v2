<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'location', 'year', 'image', 'video', 'scope',
        'description', 'client_id', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $p) {
            if (empty($p->slug)) {
                $clientName = $p->client ? $p->client->name : 'project';
                $p->slug = Str::slug($clientName . '-' . $p->year . '-' . Str::random(4));
            }
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
