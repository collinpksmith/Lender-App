<?php

declare(strict_types=1);

namespace App\Interfaces\Repositories;

/**
 * Interface PlayerRepositoryInterface
 *
 * @package App\Interfaces\Repositores
 */
interface PlayerRepositoryInterface
{
    /**
     * @param int $id
     * @return array
     */
    public function crudRules($id = 0): array;
}
