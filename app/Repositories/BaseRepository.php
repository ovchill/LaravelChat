<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Класс базового репозитория. Нужен, чтобы абстрагировать обращение к БД в отдельный слой.
 * Также небесполезен при смене базы данных. Не представляю такую ситуацию в реале, но всё же
 * было бы здорово иметь абстракцию в работе с БД.
 */
abstract class BaseRepository
{
    /**
     * @return Model
     */
    abstract protected function getModelClass(): Model;

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return $this->getModelClass()::query();
    }

    /**
     * @param array $values
     *
     * @return bool
     */
    public function insert(array $values): bool
    {
        return $this->query()->insert($values);
    }

    /**
     * @param array $find
     * @param array $values
     *
     * @return Model
     */
    public function updateOrCreate(array $find, array $values = []): Model
    {
        return $this->query()->updateOrCreate($find, $values);
    }

    /**
     * @param array $category
     *
     * @return Model
     */
    public function create(array $category): Model
    {
        return $this->query()->create($category);
    }
}
