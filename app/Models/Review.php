<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'reviewer_id',
        'rating',
        'comment',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
