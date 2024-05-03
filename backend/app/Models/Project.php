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

    // RELATIONS
    const RELATION_COMPANY = 'company';
    const RELATION_SETTINGS = 'settings';
    const RELATION_ORDERS = 'orders';
    const RELATION_TEMPLATES = 'templates';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_COMPANY_PROJECT = 'company_project';
    const PIVOT_TABLE_PROJECT_PROJECT_SETTING= 'project_project_setting';
    const PIVOT_TABLE_PROJECT_ORDER = 'project_order';
    const PIVOT_TABLE_PROJECT_TEMPLATE = 'project_template';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_PROJECT_ID = 'project_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_COMPANY_ID = 'company_id';
    const RELATED_KEY_PROJECT_SETTING_ID = 'project_setting_id';
    const RELATED_KEY_ORDER_ID = 'order_id';
    const RELATED_KEY_TEMPLATE_ID = 'template_id';
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
}
