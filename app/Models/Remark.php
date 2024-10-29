<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Remark extends Model
{
    protected $fillable = [
        'routingSlipId',
        'officeId',
        'message'
    ];

    public function routingSlip(): BelongsTo
    {
        return $this->belongsTo(RoutingSlip::class, 'routingSlipId');
    }
}
