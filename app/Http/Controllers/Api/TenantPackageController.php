<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\HotelPackage;
use Illuminate\Http\JsonResponse;

class TenantPackageController extends Controller
{
    /**
     * Get hotel packages for a tenant.
     */
    public function index(string $tenantSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $packages = HotelPackage::where('tenant_id', $tenant->id)
            ->active()
            ->with('subPackages')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        return response()->json(['data' => $packages]);
    }

    /**
     * Get single package.
     */
    public function show(string $tenantSlug, string $packageSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $package = HotelPackage::where('tenant_id', $tenant->id)
            ->where('slug', $packageSlug)
            ->active()
            ->with('subPackages')
            ->first();

        if (!$package) {
            return response()->json(['error' => 'Package not found'], 404);
        }

        return response()->json(['data' => $package]);
    }

    /**
     * Find tenant by slug.
     */
    protected function findTenantBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->active()->first();
    }
}