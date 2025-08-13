<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\TenantUser
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property array|null $permissions
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenant $tenant
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantUser whereUpdatedAt($value)
 * @method static \Database\Factories\TenantUserFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TenantUser extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'password',
        'role',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        'permissions' => 'array',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tenant that owns the user.
     *
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}