<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SocialMediaConfig
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $platform
 * @property string|null $username
 * @property string|null $url
 * @property string|null $access_token
 * @property array|null $settings
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenant $tenant
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMediaConfig active()
 * @method static \Database\Factories\SocialMediaConfigFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class SocialMediaConfig extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'platform',
        'username',
        'url',
        'access_token',
        'settings',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tenant that owns the social media config.
     *
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Scope a query to only include active configurations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}