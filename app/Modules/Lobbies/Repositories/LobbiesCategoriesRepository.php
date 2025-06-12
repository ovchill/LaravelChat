<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\Repositories;

use App\Models\LobbyCategory;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class LobbiesCategoriesRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): Model
    {
        return new LobbyCategory();
    }
}
