<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'proposalId',
        'receiverId',
        'accomplishmentDate'
    ];

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiverId');
    }
    public function routingSlips(): HasMany
    {
        return $this->hasMany(RoutingSlip::class, 'transactionId');
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class, 'proposalId');
    }
}
