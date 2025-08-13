<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\SocialMediaConfig;
use Illuminate\Http\JsonResponse;

class TenantSocialController extends Controller
{
    /**
     * Get social media configurations.
     */
    public function index(string $tenantSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $configs = SocialMediaConfig::where('tenant_id', $tenant->id)
            ->active()
            ->select('platform', 'username', 'url')
            ->get();

        return response()->json(['data' => $configs]);
    }

    /**
     * Find tenant by slug.
     */
    protected function findTenantBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->active()->first();
    }
}