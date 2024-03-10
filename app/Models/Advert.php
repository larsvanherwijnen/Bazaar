<?php

namespace App\Models;

use App\Enum\AdvertType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advert extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'type' => AdvertType::class,
    ];

    public function advertImages() : HasMany
    {
        return $this->hasMany(AdvertImage::class);
    }
}
