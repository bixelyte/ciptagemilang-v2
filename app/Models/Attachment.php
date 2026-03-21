<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'type',
        'attachable_id',
        'attachable_type',
        'sort_order',
    ];

    public function attachable()
    {
        return $this->morphTo();
    }
}
