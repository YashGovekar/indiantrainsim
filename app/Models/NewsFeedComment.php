<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsFeedComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function newsfeed(): BelongsTo
    {
        return $this->belongsTo(NewsFeed::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->toDayDateTimeString();
    }
}
