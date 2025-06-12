<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Users\Repositories\UsersRepository;

readonly class UsersService
{
    public function __construct(
        private UsersRepository $usersRepository,
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
        /** @var User $user */
        $user = $this->usersRepository->updateOrCreate([
            'name' => $name,
            'session_token' => $sessionToken,
        ]);

        return $user;
    }
}
