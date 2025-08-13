<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\HotelPackage
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $parent_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property float|null $price
 * @property string $currency
 * @property array|null $features
 * @property array|null $images
 * @property int|null $max_occupancy
 * @property int|null $duration_days
 * @property string $status
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\HotelPackage|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HotelPackage> $subPackages
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereDurationDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereMaxOccupancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelPackage active()
 * @method static \Database\Factories\HotelPackageFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class HotelPackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'parent_id',
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'features',
        'images',
        'max_occupancy',
        'duration_days',
        'status',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'images' => 'array',
        'max_occupancy' => 'integer',
        'duration_days' => 'integer',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tenant that owns the package.
     *
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the parent package.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(HotelPackage::class, 'parent_id');
    }

    /**
     * Get the sub-packages.
     *
     * @return HasMany
     */
    public function subPackages(): HasMany
    {
        return $this->hasMany(HotelPackage::class, 'parent_id');
    }

    /**
     * Scope a query to only include active packages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}