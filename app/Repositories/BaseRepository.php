<?php

namespace App\Repositories;

use App\Exception\Runtime\DataNotSaved;
use App\Interfaces\Base\BaseRepositoryInterfaces;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterfaces
{
    protected Model $model;
    private Builder $query;

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        //todo insert condition
        return $this->query()->with($relations)->get($columns);
    }

    public function query(): Builder
    {
        if (empty($this->query)) {
            $this->query = $this->model->query();
        }
        return $this->query;
    }

    public function clearQuery(): static
    {
        $this->query = $this->model->newQuery();
        return  $this;
    }


    public function paginate(int $perPage = 10, array $columns = ['*'], array $relations = []): LengthAwarePaginator
    {
        return $this->query()->with($relations)->paginate($perPage, $columns);
    }

    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->query()->select($columns)->with($relations)->find($modelId);
    }

    public function create(array $payload): Model
    {
        return $this->model->create($payload);
    }

    public function deleteById(int $modelId): bool
    {
        return $this->findByIdOrFail($modelId)->delete();
    }

    public function destroy(int $modelId)
    {
        return $this->model->destroy($modelId);
    }

    public function findByIdOrFail(
        int $modelId,
        array $columns = ['*'],
        array $relations = []
    ): Model {
        return $this->query()->with($relations)->findOrFail($modelId, $columns);
    }

    public function sort(?string $sortBy = null, string $sortType = 'asc'): static
    {
        $this->query()->orderBy($sortBy ? $sortBy : $this->model->getQualifiedKeyName(), $sortType);
        return $this;
    }

    public function count(): int
    {
        return $this->query()->count();
    }

    public function first(
        array $columns = ['*'],
        array $relations = []
    ): ?Model {
        return $this->query()->with($relations)->first($columns);
    }


    public function firstOrFail(
        array $columns = ['*'],
        array $relations = []
    ): Model {
        return $this->query()->with($relations)->firstOrFail($columns);
    }


    public function whereId(int $modelId): static
    {
        $this->query()->whereId($modelId);
        return $this;
    }

    public function withCount(string|array $relations): static
    {
        $this->query()->withCount($relations);

        return $this;
    }

    public function directDelete(): bool
    {
        return $this->query()->delete();
    }


    public function exists(): bool
    {
        return $this->query()->exists();
    }


    public function directUpdate(array $payload): bool
    {
        return $this->query()->update($payload);
    }


    public function update(int $modelId, array $payload): bool
    {
        return $this->findByIdOrFail($modelId)->update($payload);
    }

    public function batchUpdate(array $ids, array $payLoad): bool
    {
        return $this->query()->whereIn('id', $ids)->update($payLoad);
    }
    public function limit(int $number): static
    {
        $this->query()->limit($number);
        return $this;
    }

    public function batchInsert(array $payload): bool
    {
        DB::transaction(callback: function () use ($payload) {
            for ($i = 0, $iMax = count($payload); $i < $iMax; $i += 100) {
                $chunk = array_slice($payload, $i, 100);
                $res = $this->model->insert($chunk);
                if (!$res) {
                    throw new DataNotSaved();
                }
            }
        });
        return true;
    }

}
