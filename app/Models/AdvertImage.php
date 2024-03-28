<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $id
 * @property string $path
 * @property string $advert_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AdvertImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertImage extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
    ];
}
