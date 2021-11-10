<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Interfaces\Repositories\TeamRepositoryInterface;
use App\Models\Team;

use Illuminate\Validation\Rule;

class TeamRepository extends AbstractRepository implements TeamRepositoryInterface
{
    /**
     * TeamRepository constructor
     * @param Team $model
     */
    public function __construct(Team $model)
    {
        parent::__construct($model);
    }

    /**
     * Team Model Create and Update Rules
     *
     * @param int $id
     * @return array
     */
    public function crudRules($id = 0): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Team::class)->ignore($id),
            ],
        ];
    }
}
