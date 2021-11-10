<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * @package App\ModelsTeam
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Team extends Model
{
    // In Laravel 8, we need to use the trait
    use HasFactory;

    /** @var string */
    protected $table = 'teams';

    /** @var array */
    protected $guarded = ['id'];

    /** @return HasMany */
    public function players(): HasMany {
        return $this->hasMany(Player::class);
    }
}
