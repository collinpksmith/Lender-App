<?php

declare(strict_types=1);

namespace App\Interfaces\Repositories;

/**
 * Interface TeamRepositoryInterface
 *
 * @package App\Interfaces\Repositores
 */
interface TeamRepositoryInterface
{
    /**
     * @param int $id
     * @return array
     */
    public function crudRules($id = 0): array;
}
