<?php

namespace App\Models;

use App\Enum\AdvertType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adverts extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => AdvertType::class,
    ];

}
