<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\Services;

use App\Models\Lobby;
use App\Modules\Lobbies\Repositories\LobbiesRepository;

class LobbyService
{
    public function __construct(
        private readonly LobbiesRepository $lobbyRepository,
    )
    {}

    /**
     * @param int[] $categoryIds
     *
     * @return Lobby|null
     */
    public function findLobbyByCategoryIds(array $categoryIds): ?Lobby
    {
        return null;
    }

    public function createLobbyByCategoryIds(array $getCategories): Lobby
    {
//        $this->lobbyRepository->updateOrCreate()
    }
}
