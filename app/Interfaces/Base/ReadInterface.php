<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ReadInterface
{
    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * @param int $perPage
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function paginate(int $perPage, array $columns = ['*'], array $relations = []): LengthAwarePaginator;

    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function findByIdOrFail(
        int $modelId,
        array $columns = ['*'],
        array $relations = []
    ): Model;

    /**
     * @param array $columns
     * @param array $relations
     * @return Model|null
     */
    public function first(
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    /**
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function firstOrFail(
        array $columns = ['*'],
        array $relations = []
    ): Model;
}
