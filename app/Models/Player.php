<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * @package App\Models\Player
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $team_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Team $team
 */
class Player extends Model
{
    // In Laravel 8, we need to use the trait
    use HasFactory;

    /** @var string */
    protected $table = 'players';

    /** @var array */
    protected $guarded = ['id'];

    /** @return BelongsTo */
    public function team(): BelongsTo {
        return $this->belongsTo(Team::class);
    }
}
