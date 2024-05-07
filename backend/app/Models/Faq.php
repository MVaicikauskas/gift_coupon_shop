<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faq extends Model
{
    use HasFactory;

    const COL_ID = 'id';
    const COL_HEADER = 'header';
    const COL_DESCRIPTION = 'description';
    const COL_POSITION_INDEX = 'position_index';
    const COL_CREATED_AT = 'created_at';
    const EXTRA_COL_PROJECT_ID = 'project_id';

    // RELATIONS
    const RELATION_PROJECT = 'project';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_PROJECT_FAQ = 'project_faq';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_FAQ_ID = 'faq_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_PROJECT_ID = 'project_id';
    // END RELATED KEYS

    protected $casts = [
        self::COL_CREATED_AT => 'date',
    ];

    protected $fillable = [
        self::COL_HEADER,
        self::COL_DESCRIPTION,
        self::COL_POSITION_INDEX,
    ];

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, self::PIVOT_TABLE_PROJECT_FAQ, self::FOREIGN_KEY_FAQ_ID, self::RELATED_KEY_PROJECT_ID);
    }
}
