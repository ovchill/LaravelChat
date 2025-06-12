<?php

declare(strict_types=1);
declare(ticks=1000);

namespace App\Modules\Users\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): Model
    {
        return new User();
    }
}
