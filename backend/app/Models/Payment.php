<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_BANK_KEY = 'bank_key';
    const COL_TRANSACTION_STATUS = 'transaction_status';
    const COL_CREATED_AT = 'created_at';

    // RELATIONS
    const RELATION_ORDER = 'order';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_PAYMENT_ORDER = 'payment_order';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_PAYMENT_ID = 'payment_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_ORDER_ID = 'order_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_BANK_KEY,
        self::COL_TRANSACTION_STATUS,
    ];

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, self::PIVOT_TABLE_PAYMENT_ORDER, self::FOREIGN_KEY_PAYMENT_ID, self::RELATED_KEY_ORDER_ID);
    }
}
