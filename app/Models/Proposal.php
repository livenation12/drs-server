<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proposal extends Model
{
    protected $fillable = [
        'trackingId',
        'source',
        'sourceType',
        'title',
        'description',
        'attachment',
    ];

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'proposalId');
    }
}
