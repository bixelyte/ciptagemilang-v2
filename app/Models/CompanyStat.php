<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CompanyStat extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['label'];

    protected $fillable = [
        'icon', 'value', 'label', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }
}
