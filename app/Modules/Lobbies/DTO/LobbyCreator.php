<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\DTO;

class LobbyCreator
{
    public function __construct(
        private readonly bool $isClosed,
        private readonly int  $usersLimit,
        private array         $categoriesIds,
    )
    {
        $this->categoriesIds = array_map('intval', $categoriesIds);
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    /**
     * @return int
     */
    public function getUsersLimit(): int
    {
        return $this->usersLimit;
    }

    /**
     * @return int[]
     */
    public function getCategoriesIds(): array
    {
        return $this->categoriesIds;
    }
}
