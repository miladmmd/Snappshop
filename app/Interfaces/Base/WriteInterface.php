<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Model;

interface WriteInterface
{
    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * @param int $modelId
     * @param array $payload
     * @return bool
     */

    public function update(int $modelId,array $payload): bool;

    /**
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * @return bool
     */
    public function directDelete(): bool;

    /**
     * @return bool
     */
    public function directUpdate(array $payload): bool;

    public function batchInsert(array $payload): bool;

}
