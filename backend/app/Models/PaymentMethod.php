<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentMethod extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_KEY = 'key';
    const COL_IS_ACTIVE = 'is_active';
    const COL_CREATED_AT = 'created_at';

    // RELATIONS
    const RELATION_PROJECT = 'project';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_PROJECT_PAYMENT_METHOD = 'project_payment_method';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_PAYMENT_METHOD_ID = 'payment_method_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_PROJECT_ID = 'project_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_KEY,
        self::COL_IS_ACTIVE,
    ];

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, self::PIVOT_TABLE_PROJECT_PAYMENT_METHOD, self::FOREIGN_KEY_PAYMENT_METHOD_ID, self::RELATED_KEY_PROJECT_ID);
    }
}
