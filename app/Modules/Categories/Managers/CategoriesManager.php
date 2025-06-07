<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Categories\Managers;

use App\Modules\Categories\Repositories\CategoriesRepository;

readonly class CategoriesManager
{
    public function __construct(
        private CategoriesRepository $categoriesRepository
    )
    {}

    /**
     * Получаем категории для отображения на фронте для выбора чата
     *
     * @return array
     */
    public function getCategoriesForFront(): array
    {
        return $this->categoriesRepository->getAll(['title', 'logo'])->all();
    }
}
