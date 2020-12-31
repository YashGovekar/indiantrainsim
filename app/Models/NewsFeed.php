<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Storage;

class NewsFeed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAttribute($value): string
    {
        return Storage::url($value);
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->toDayDateTimeString();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(NewsFeedComment::class);
    }
}
