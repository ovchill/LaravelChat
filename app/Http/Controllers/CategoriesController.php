<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Http\Controllers;

use App\Modules\Categories\Managers\CategoriesManager;

class CategoriesController extends Controller
{
    /**
     * @param CategoriesManager $manager
     *
     * @return array
     */
    public function getCategoriesForFront(CategoriesManager $manager): array
    {
        return $manager->getCategoriesForFront();
    }
}
