<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Http\Controllers;

use App\Http\Requests\FindLobbyRequest;
use App\Modules\Lobbies\DTO\LobbySeeker;
use App\Modules\Lobbies\Managers\LobbyManager;

class LobbiesController extends Controller
{
    /**
     * @param FindLobbyRequest $request
     * @param LobbyManager $manager
     *
     * @return void
     */
    public function findLobby(FindLobbyRequest $request, LobbyManager $manager): void
    {
        $request->validated();

        $seeker = new LobbySeeker(
            $request->get('sex'),
            $request->get('nickname'),
            $request->get('categoriesIds'),
        );

        $manager->findLobby($seeker);
    }
}
