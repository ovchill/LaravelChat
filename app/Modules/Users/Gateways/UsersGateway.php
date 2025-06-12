<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Users\Gateways;

use App\Models\User;
use App\Modules\Users\Services\UsersService;

readonly class UsersGateway
{
    public function __construct(
        private UsersService $usersService
    )
    {
    }

    /**
     * @param string $name
     * @param string $sessionToken
     *
     * @return User
     */
    public function firstOrCreateUser(string $name, string $sessionToken): User
    {
        return $this->usersService->firstOrCreateUser($name, $sessionToken);
    }
}
