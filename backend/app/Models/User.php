<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_SURNAME = 'surname';
    const COL_EMAIL = 'email';
    const COL_EMAIL_VERIFIED_AT = 'email_verified_at';
    const COL_PASSWORD = 'password';
    const COL_REMEMBER_TOKEN = 'remember_token';
    const COL_CREATED_AT = 'created_at';

    // RELATIONS
    const RELATION_COMPANIES = 'companies';
    // END RELATIONS

    // PIVOT TABLES
    const PIVOT_TABLE_USER_COMPANY = 'user_company';
    // END PIVOT TABLES

    // FOREIGN KEYS
    const FOREIGN_KEY_USER_ID = 'user_id';
    // END FOREIGN KEYS

    // RELATED KEYS
    const RELATED_KEY_COMPANY_ID = 'company_id';
    // END RELATED KEYS

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::COL_NAME,
        self::COL_EMAIL,
        self::COL_PASSWORD,
        self::COL_REMEMBER_TOKEN,
        self::COL_EMAIL_VERIFIED_AT
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, self::PIVOT_TABLE_USER_COMPANY, self::FOREIGN_KEY_USER_ID, self::RELATED_KEY_COMPANY_ID);
    }
}
