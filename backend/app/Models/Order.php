<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_RECIPIENT_NAME = 'recipient_name';
    const COL_EMAIL = 'email';
    const COL_WISH = 'wish';
    const COL_ACCEPT_PRIVACY_POLICY = 'accept_privacy_policy';
    const COL_VALUE = 'value';
    const COL_COUPON_DELIVERY = 'coupon_delivery';
    const COL_COUPON_TYPE = 'coupon_type';
    const COL_COUPON_STATUS = 'coupon_status';
    const COL_PICKUP_COORDINATES = 'pickup_coordinates';
    const COL_SELECTED_BANK= 'selected_bank';
    const COL_CREATED_AT = 'created_at';

    // EXTRA CONSTANTS
    const EXTRA_COL_PROJECT_ID = 'project_id';
    // END EXTRA CONSTANTS

    // COUPON DELIVERY TYPES
    public static array $deliveryTypes = [
        self::COUPON_DELIVERY_EMAIL,
        self::COUPON_DELIVERY_PHYSICAL_PICKUP,
        self::COUPON_DELIVERY_BY_DELIVERY_PERSON,
    ];
    const COUPON_DELIVERY_EMAIL = 1;
    const COUPON_DELIVERY_PHYSICAL_PICKUP = 2;
    const COUPON_DELIVERY_BY_DELIVERY_PERSON = 3;
    // END COUPON DELIVERY TYPES

    // RELATIONS
    const RELATION_PAYMENT = 'payment';
    const RELATION_PROJECT = 'project';
    const RELATION_COUPON= 'coupon';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_PROJECT_ORDER = 'project_order';
    const PIVOT_TABLE_PAYMENT_ORDER = 'payment_order';
    const PIVOT_TABLE_COUPON_ORDER = 'coupon_order';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_ORDER_ID = 'order_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_PAYMENT_ID = 'payment_id';
    const RELATED_KEY_COUPON_ID = 'coupon_id';
    const RELATED_KEY_PROJECT_ID = 'project_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_RECIPIENT_NAME,
        self::COL_EMAIL,
        self::COL_WISH,
        self::COL_ACCEPT_PRIVACY_POLICY,
        self::COL_VALUE,
        self::COL_COUPON_DELIVERY,
        self::COL_COUPON_TYPE,
        self::COL_COUPON_STATUS,
        self::COL_PICKUP_COORDINATES,
        self::COL_SELECTED_BANK,
    ];

    public function payment(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class, self::PIVOT_TABLE_PAYMENT_ORDER, self::FOREIGN_KEY_ORDER_ID, self::RELATED_KEY_PAYMENT_ID);
    }

    public function coupon(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, self::PIVOT_TABLE_COUPON_ORDER, self::FOREIGN_KEY_ORDER_ID, self::RELATED_KEY_COUPON_ID);
    }

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, self::PIVOT_TABLE_PROJECT_ORDER, self::FOREIGN_KEY_ORDER_ID, self::RELATED_KEY_PROJECT_ID);
    }
}
