<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\Managers;

use App\Modules\Lobbies\DTO\LobbySeeker;
use App\Modules\Lobbies\Services\LobbyService;

class LobbyManager
{
    public function __construct(
        private readonly LobbyService $lobbyService,
    )
    {}

    /**
     * @param LobbySeeker $seeker
     *
     * @return void
     */
    public function findLobby(LobbySeeker $seeker): void
    {
        $lobby = $this->lobbyService->findLobbyByCategoryIds($seeker->getCategories());

        if (!$lobby) {
            $lobby = $this->lobbyService->createLobbyByCategoryIds($seeker->getCategories());
        }
    }
}
