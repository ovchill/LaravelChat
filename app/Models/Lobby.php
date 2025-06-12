<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property bool $isClosed - Закрыт ли чат. Если да, подключиться к нему нельзя, храним для истории
 * @property int $usersLimit - Максимальное количество участников в чате
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class Lobby extends Model
{
    protected $table = 'lobbies';
    protected $fillable = ['is_closed', 'users_limit', 'created_at', 'updated_at'];

    public function categories(): HasMany
    {
        return $this->hasMany(LobbyCategory::class);
    }
}
