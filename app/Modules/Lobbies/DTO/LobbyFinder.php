<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\DTO;

readonly class LobbyFinder
{
    public function __construct(
        private array $categoriyIds,
        private int   $usersLimit,
    )
    {
    }

    /**
     * @return int[]
     */
    public function getCategoriyIds(): array
    {
        return $this->categoriyIds;
    }

    /**
     * @return int
     */
    public function getUsersLimit(): int
    {
        return $this->usersLimit;
    }
}
