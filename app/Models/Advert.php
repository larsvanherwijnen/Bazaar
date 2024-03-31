<?php

namespace App\Models;

use App\Enum\AdvertType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $description
 * @property AdvertType $type
 * @property string|null $price
 * @property string|null $starting_price
 * @property string|null $start_date
 * @property string|null $expiry_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdvertImage> $advertImages
 * @property-read int|null $advert_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bid> $bids
 * @property-read int|null $bids_count
 * @property-read string $end_date
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\AdvertFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereStartingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUserId($value)
 *
 * @mixin \Eloquent
 */
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

    public function relatedAdverts(): BelongsToMany
    {
        return $this->belongsToMany(Advert::class, 'advert_advert', 'advert_id', 'related_advert_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
