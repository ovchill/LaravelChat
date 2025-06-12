<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\Services;

use App\Models\Lobby;
use App\Models\User;
use App\Modules\Lobbies\DTO\LobbyCreator;
use App\Modules\Lobbies\DTO\LobbyFinder;
use App\Modules\Lobbies\DTO\LobbySeeker;
use App\Modules\Lobbies\Repositories\LobbiesCategoriesRepository;
use App\Modules\Lobbies\Repositories\LobbiesRepository;
use App\Modules\Lobbies\Repositories\LobbiesUsersRepository;

readonly class LobbyService
{
    public function __construct(
        private LobbiesRepository           $lobbyRepository,
        private LobbiesCategoriesRepository $lobbyCategoriesRepository,
        private LobbiesUsersRepository $lobbiesUsersRepository,
    )
    {
    }

    /**
     * @param LobbyFinder $lobbyFinder
     *
     * @return Lobby|null
     */
    public function findLobbyByCategoryIds(LobbyFinder $lobbyFinder): ?Lobby
    {
        return null;
    }

    public function createLobbyByDtoCreator(LobbyCreator $lobbyCreator): Lobby
    {
        /** @var Lobby $lobby */
        $lobby = $this->lobbyRepository->create([
            'is_closed' => $lobbyCreator->isClosed(),
            'users_limit' => $lobbyCreator->getUsersLimit(),
        ]);

        /**
         * При неудачном сохранении одной из категорий вызываем ошибку
         */
        $insertCategoriesStatuses = [];
        foreach ($lobbyCreator->getCategoriesIds() as $categoriesId) {
            $insertCategoriesStatuses[] = $this->lobbyCategoriesRepository->insert([
                'lobby_id' => $lobby->id,
                'category_id' => $categoriesId,
        ]);
        }

        if (in_array(false, $insertCategoriesStatuses, true)) {
            throw new \RuntimeException(
                'Непредвиденная ошибка при создании категории лобби, повторите попытку позднее'
            );
        }

        return $lobby;
    }

    /**
     * @param User $user
     * @param Lobby $lobby
     *
     * @return void
     */
    public function connectSeekerToLobby(User $user, Lobby $lobby): void
    {
        $this->lobbiesUsersRepository->updateOrCreate([
            'lobby_id' => $lobby->id,
            'user_id' => $user->id,
        ]);
    }
}
