<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TenantApiController extends Controller
{
    /**
     * Get tenant by slug or domain.
     */
    public function show(Request $request, string $identifier): JsonResponse
    {
        $tenant = Tenant::where('slug', $identifier)
            ->orWhere('domain', $identifier)
            ->active()
            ->first();

        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        return response()->json(['data' => $tenant]);
    }
}