<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Builder;

interface BaseRepositoryInterfaces extends ReadInterface, WriteInterface
{
    /**
     * singletone method
     * @return Builder
     */
    public function query(): Builder;

    public function clearQuery(): static;

    /**
     * @param ?string $sortBy
     * @param string $sortType
     * @return static
     */
    public function sort(?string $sortBy = null, string $sortType = 'asc'): static;

    /**
     * @param int $modelId
     * @return static
     */
    public function whereId(int $modelId): static;

    /**
     * @param array $ids
     * @param array $payLoad
     * @return bool
     */
    public function batchUpdate(array $ids, array $payLoad): bool;

    public function withCount(string|array $relations): static;

    public function destroy(int $modelId);

    public function limit(int $number);
}
