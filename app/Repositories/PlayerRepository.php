<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Interfaces\Repositories\PlayerRepositoryInterface;
use App\Models\Player;

class PlayerRepository extends AbstractRepository implements PlayerRepositoryInterface
{
    /**
     * PlayerRepository constructor
     * @param Player $model
     */
    public function __construct(Player $model)
    {
        parent::__construct($model);
    }

    /**
     * Player Model Create and Update Rules
     *
     * @param int $id
     * @return array
     */
    public function crudRules($id = 0): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'team_id' => 'exists:teams,id',
        ];
    }
}
