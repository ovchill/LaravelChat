<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\Managers;

use App\Modules\Lobbies\DTO\LobbyCreator;
use App\Modules\Lobbies\DTO\LobbyFinder;
use App\Modules\Lobbies\DTO\LobbySeeker;
use App\Modules\Lobbies\Services\LobbyService;
use App\Modules\Users\Gateways\UsersGateway;

readonly class LobbyManager
{
    public function __construct(
        private LobbyService $lobbyService,
        private UsersGateway $usersGateway,
    )
    {
    }

    /**
     * Подключаем пользователя к лобби.
     * Сначала пытаемся найти лобби. Если не выходит этого сделать, создаём новое и подключаем туда пользователя.
     *
     * @param LobbySeeker $seeker
     *
     * @return void
     */
    public function connectUserToLobby(LobbySeeker $seeker): void
    {
        $lobby = $this->lobbyService->findLobbyByCategoryIds(
            new LobbyFinder(
                $seeker->getCategoryIds(),
                $seeker->getUsersLimit(),
            )
        );

        if (!($lobby)) {
            $lobby = $this->lobbyService->createLobbyByDtoCreator(
                new LobbyCreator(
                    false,
                    $seeker->getUsersLimit(),
                    $seeker->getCategoryIds(),
                )
            );
        }

        if (!$lobby) {
            throw new \RuntimeException('Неожиданная ошибка при попытке создать лобби, повторите попытку позднее');
        }

        $user = $this->usersGateway->firstOrCreateUser($seeker->getNickname(), $seeker->getSessionToken());

        $this->lobbyService->connectSeekerToLobby($user, $lobby);
    }
}
