<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property string $id
 * @property string $user_id
 * @property string|null $approved_by
 * @property string $path
 * @property string|null $approved_at
 * @property-read \App\Models\User|null $approvedBy
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ContractFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUserId($value)
 * @mixin \Eloquent
 */
class Contract extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'approved_by',
        'path',
        'approved_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
