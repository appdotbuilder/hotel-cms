<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;

class TenantGalleryController extends Controller
{
    /**
     * Get galleries for a tenant.
     */
    public function index(string $tenantSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $galleries = Gallery::where('tenant_id', $tenant->id)
            ->active()
            ->orderBy('sort_order')
            ->get();

        return response()->json(['data' => $galleries]);
    }

    /**
     * Get single gallery.
     */
    public function show(string $tenantSlug, string $gallerySlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $gallery = Gallery::where('tenant_id', $tenant->id)
            ->where('slug', $gallerySlug)
            ->active()
            ->first();

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        return response()->json(['data' => $gallery]);
    }

    /**
     * Find tenant by slug.
     */
    protected function findTenantBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->active()->first();
    }
}