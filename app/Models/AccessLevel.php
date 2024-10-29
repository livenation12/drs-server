<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccessLevel extends Model
{
    protected $table = 'access_levels';
    protected $fillable = [
        'level',
        'description',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'levelId')->whereIn('level', [0, 2]);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'levelId')->whereIn('level', '>', 2);
    }
}
