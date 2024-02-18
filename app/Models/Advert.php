<?php

namespace App\Models;

use App\Enum\AdvertType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'type' => AdvertType::class,
    ];

    public function advertImages()
    {
        return $this->hasMany(AdvertImage::class);
    }
}
