<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Screenshot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPathAttribute($path): string
    {
        return Storage::url($path);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
