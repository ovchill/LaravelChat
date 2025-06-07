<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Categories\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoriesRepository extends BaseRepository
{
    /**
     * @return Model
     */
    protected function getModelClass(): Model
    {
        return new Category();
    }

    /**
     * @param array $columns
     *
     * @return Collection
     */
    public function getAll(array $columns): Collection
    {
        return Category::all($columns);
    }
}
