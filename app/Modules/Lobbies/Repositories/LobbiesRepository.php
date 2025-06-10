<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\Repositories;

use App\Models\Lobby;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class LobbiesRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): Model
    {
        return new Lobby();
    }
}
