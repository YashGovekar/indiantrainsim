<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Storage;

/**
 * @property string path
 */
class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user_downloads(): HasMany
    {
        return $this->hasMany(UserDownload::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(FileSection::class, 'file_section_id', 'id');
    }

    protected $casts = [
        'approved' => 'boolean',
        'size'     => 'integer',
    ];

    public function getImageAttribute($value): string
    {
        return Storage::url($value);
    }
}
