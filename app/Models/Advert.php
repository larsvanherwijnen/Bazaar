<?php

namespace App\Models;

use App\Enum\AdvertType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advert extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'description',
        'type',
        'price',
        'starting_price',
        'start_date',
        'expiry_date',
    ];

    protected $casts = [
        'type' => AdvertType::class,
    ];

    public function advertImages(): HasMany
    {
        return $this->hasMany(AdvertImage::class);
    }

    public function getEndDateAttribute(): string
    {
        return $this->attributes['expiry_date'];
    }
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }
}
