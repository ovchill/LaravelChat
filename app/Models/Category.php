<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $logo
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class Category extends Model
{
    public $timestamps = true;
    protected $table = 'categories';
    protected $fillable = [
        'title',
        'logo',
        'created_at',
        'updated_at',
    ];
    protected $guarded = ['id'];
}
