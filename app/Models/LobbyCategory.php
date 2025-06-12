<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $categoryId
 * @property int $lobbyId
 */
class LobbyCategory extends Model
{
    protected $table = 'lobbies_categories';
    public $timestamps = false;
    protected $fillable = ['id', 'category_id', 'lobby_id'];
}
