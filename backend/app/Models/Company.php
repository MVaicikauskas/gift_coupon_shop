<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_EMAIL = 'email';
    const COL_VAT = 'vat';
    const COL_COMPANY_CODE = 'company_code';
    const COL_CREATED_AT = 'created_at';
    const EXTRA_COL_USER_ID = 'user_id';

    // RELATIONS
    const RELATION_PROJECTS = 'projects';
    const RELATION_USER = 'user';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_COMPANY_PROJECT = 'company_project';
    const PIVOT_TABLE_USER_COMPANY = 'user_company';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_COMPANY_ID = 'company_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_PROJECT_ID = 'project_id';
    const RELATED_KEY_USER_ID = 'user_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_NAME,
        self::COL_EMAIL,
        self::COL_VAT,
        self::COL_COMPANY_CODE,
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, self::PIVOT_TABLE_COMPANY_PROJECT, self::FOREIGN_KEY_COMPANY_ID, self::RELATED_KEY_PROJECT_ID);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(USer::class, self::PIVOT_TABLE_USER_COMPANY, self::FOREIGN_KEY_COMPANY_ID, self::RELATED_KEY_USER_ID);
    }
}
