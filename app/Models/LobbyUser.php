<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $lobbyId
 * @property int $userId
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class LobbyUser extends Model
{
    protected $table = 'lobby_users';
    protected $fillable = ['lobby_id', 'user_id', 'created_at', 'updated_at'];
}
