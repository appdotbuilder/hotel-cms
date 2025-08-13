<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;

class TenantOfferController extends Controller
{
    /**
     * Get offers for a tenant.
     */
    public function index(string $tenantSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $offers = Offer::where('tenant_id', $tenant->id)
            ->active()
            ->valid()
            ->latest('valid_from')
            ->get();

        return response()->json(['data' => $offers]);
    }

    /**
     * Find tenant by slug.
     */
    protected function findTenantBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->active()->first();
    }
}