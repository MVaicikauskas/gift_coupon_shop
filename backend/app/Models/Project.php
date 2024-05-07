<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_IS_ACTIVE = 'is_active';
    const COL_CREATED_AT = 'created_at';
    const EXTRA_COL_COMPANY_ID = 'company_id';

    // RELATIONS
    const RELATION_COMPANY = 'company';
    const RELATION_SETTINGS = 'settings';
    const RELATION_ORDERS = 'orders';
    const RELATION_TEMPLATES = 'templates';
    const RELATION_FAQS = 'faqs';
    const RELATION_PAYMENT_METHOD = 'paymentMethod';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_COMPANY_PROJECT = 'company_project';
    const PIVOT_TABLE_PROJECT_PROJECT_SETTING= 'project_project_setting';
    const PIVOT_TABLE_PROJECT_ORDER = 'project_order';
    const PIVOT_TABLE_PROJECT_TEMPLATE = 'project_template';
    const PIVOT_TABLE_PROJECT_FAQ = 'project_faq';
    const PIVOT_TABLE_PROJECT_PAYMENT_METHOD = 'project_payment_method';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_PROJECT_ID = 'project_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_COMPANY_ID = 'company_id';
    const RELATED_KEY_PROJECT_SETTING_ID = 'project_setting_id';
    const RELATED_KEY_ORDER_ID = 'order_id';
    const RELATED_KEY_TEMPLATE_ID = 'template_id';
    const RELATED_KEY_FAQ_ID = 'faq_id';
    const RELATED_KEY_PAYMENT_METHOD_ID = 'payment_method_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_NAME,
        self::COL_IS_ACTIVE,
    ];

    public function company(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, self::PIVOT_TABLE_COMPANY_PROJECT, self::FOREIGN_KEY_PROJECT_ID, self::RELATED_KEY_COMPANY_ID);
    }

    public function settings(): BelongsToMany
    {
        return $this->belongsToMany(ProjectSetting::class, self::PIVOT_TABLE_PROJECT_PROJECT_SETTING, self::FOREIGN_KEY_PROJECT_ID, self::RELATED_KEY_PROJECT_SETTING_ID);
    }

    public function orders(): belongsToMany
    {
        return $this->belongsToMany(Order::class, self::PIVOT_TABLE_PROJECT_ORDER, self::FOREIGN_KEY_PROJECT_ID, self::RELATED_KEY_ORDER_ID);
    }

    public function templates(): belongsToMany
    {
        return $this->belongsToMany(Template::class, self::PIVOT_TABLE_PROJECT_TEMPLATE, self::FOREIGN_KEY_PROJECT_ID, self::RELATED_KEY_TEMPLATE_ID);
    }

    public function faqs(): belongsToMany
    {
        return $this->belongsToMany(Faq::class, self::PIVOT_TABLE_PROJECT_FAQ, self::FOREIGN_KEY_PROJECT_ID, self::RELATED_KEY_FAQ_ID);
    }

    public function paymentMethod(): belongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, self::PIVOT_TABLE_PROJECT_PAYMENT_METHOD, self::FOREIGN_KEY_PROJECT_ID, self::RELATED_KEY_PAYMENT_METHOD_ID);
    }
}
