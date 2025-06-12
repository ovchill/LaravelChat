<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Lobbies\DTO;

/**
 * Класс клиента, ищущего лобби
 */
readonly class LobbySeeker
{
    public function __construct(
        private string $sex,
        private string $nickname,
        private array  $categoryIds,
        private string $sessionToken,
        private int    $usersLimit,
    )
    {}

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return int[]
     */
    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    /**
     * @return string
     */
    public function getSessionToken(): string
    {
        return $this->sessionToken;
    }

    public function getUsersLimit()
    {
        return $this->usersLimit;
    }
}
