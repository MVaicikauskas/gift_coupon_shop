<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Template extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_TEMPLATE_KEY = 'template_key';
    const COL_IS_ACTIVE = 'is_active';
    const COL_CONTENT = 'content';
    const COL_CREATED_AT = 'created_at';

    // EXTRA CONSTANTS
    const EXTRA_COL_PROJECT_ID = 'project_id';
    // END EXTRA CONSTANTS

    // RELATIONS
    const RELATION_PROJECT = 'project';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_PROJECT_TEMPLATE = 'project_template';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_TEMPLATE_ID = 'template_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_PROJECT_ID = 'project_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_TEMPLATE_KEY,
        self::COL_IS_ACTIVE,
        self::COL_CONTENT,
    ];


    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, self::PIVOT_TABLE_PROJECT_TEMPLATE, self::FOREIGN_KEY_TEMPLATE_ID, self::RELATED_KEY_PROJECT_ID);
    }
}
