<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProjectSetting extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_SETTINGS = 'settings';
    const COL_CREATED_AT = 'created_at';
    const EXTRA_COL_PROJECT_ID= 'project_id';

    //SETTINGS' KEYS
    const SETTING_KEY_VALUES = 'values';
    const SETTING_KEY_COUPON_TYPES = 'coupon_types';
    // END SETTINGS' KEYS

    // RELATIONS
    const RELATION_PROJECT = 'project';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_PROJECT_PROJECT_SETTING = 'project_project_setting';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_PROJECT_SETTING_ID = 'project_setting_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_PROJECT_ID = 'project_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
        self::COL_SETTINGS => 'json',
    ];

    protected $fillable = [
        self::COL_SETTINGS,
    ];

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, self::PIVOT_TABLE_PROJECT_PROJECT_SETTING, self::FOREIGN_KEY_PROJECT_SETTING_ID, self::RELATED_KEY_PROJECT_ID);
    }
}