<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoutingSlip extends Model
{
    protected $table = 'routing_slips';

    protected $fillable = [
        'drsNo',
        'fromUserId',
        'urgency',
        'subject',
        'action',
        'endorsedToOfficeId',
        'status',
        'additionalRemarks',
        'actionRequested',
        'transactionId',
    ];

    public function transactions(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transactionId');
    }

    public function endorsedToOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'endorsedToOfficeId');
    }

    public function remarks(): HasMany
    {
        return $this->hasMany(Remark::class, 'routingSlipId');
    }
}
