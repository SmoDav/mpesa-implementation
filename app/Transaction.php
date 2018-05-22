<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_COMPLETE = 1;
    const STATUS_FAILED = 2;

    protected $fillable = [
        'status', 'invoice_id', 'transaction_number', 'transaction_time', 'amount', 'short_code', 'bill_reference',
        'mobile_number', 'payer_first_name', 'payer_middle_name', 'payer_last_name'
    ];

    /**
     * The invoice relation
     *
     * @return BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
