<?php

namespace Database\Seeders;

use App\Modules\Categories\Repositories\CategoriesRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function __construct(
        private readonly CategoriesRepository $categoriesRepository
    )
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultCategories = [
            [
                'title' => 'Спорт',
                'logo' => 'faHockeyPuck',
            ],
            [
                'title' => 'Политика',
                'logo' => 'faLandmark',
            ],
            [
                'title' => 'Игры',
                'logo' => 'faGamepad',
            ],
            [
                'title' => 'Книги',
                'logo' => 'faBook',
            ],
            [
                'title' => 'Путешествия',
                'logo' => 'faPlane',
            ],
            [
                'title' => 'Работа',
                'logo' => 'faBriefcase',
            ],
        ];

        foreach ($defaultCategories as $category) {
            $this->categoriesRepository->updateOrCreate($category, []);
        }
    }
}
