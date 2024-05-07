<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_BANK_NAME = 'bank_name';
    const COL_BANK_CODE = 'bank_code';
    const COL_TRANSACTION_STATUS = 'transaction_status';
    const COL_PAYMENT_METHOD = 'payment_method';
    const COL_CREATED_AT = 'created_at';
    const EXTRA_COL_PROJECT_ID = 'project_id';
    const EXTRA_COL_COMPANY_ID = 'company_id';

    // TRANSACTION STATUSES
    const TRANSACTION_STATUS_ONGOING = 0;
    const TRANSACTION_STATUS_PAID = 1;
    const TRANSACTION_STATUS_CANCELLED = 3;
    const TRANSACTION_STATUS_FAILED = 4;

    public static array $transactionStatuses = [
        self::TRANSACTION_STATUS_ONGOING,
        self::TRANSACTION_STATUS_PAID,
        self::TRANSACTION_STATUS_CANCELLED,
        self::TRANSACTION_STATUS_FAILED
    ];
    // END TRANSACTION STATUSES

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
        self::COL_BANK_NAME,
        self::COL_BANK_CODE,
        self::COL_TRANSACTION_STATUS,
        self::COL_PAYMENT_METHOD,
    ];

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, self::PIVOT_TABLE_PAYMENT_ORDER, self::FOREIGN_KEY_PAYMENT_ID, self::RELATED_KEY_ORDER_ID);
    }
}
