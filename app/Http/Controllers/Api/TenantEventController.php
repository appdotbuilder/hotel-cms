<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class TenantEventController extends Controller
{
    /**
     * Get events for a tenant.
     */
    public function index(string $tenantSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $events = Event::where('tenant_id', $tenant->id)
            ->upcoming()
            ->orderBy('start_datetime')
            ->get();

        return response()->json(['data' => $events]);
    }

    /**
     * Find tenant by slug.
     */
    protected function findTenantBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->active()->first();
    }
}