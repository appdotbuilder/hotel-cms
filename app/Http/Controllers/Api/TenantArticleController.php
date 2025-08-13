<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TenantArticleController extends Controller
{
    /**
     * Get articles for a tenant.
     */
    public function index(Request $request, string $tenantSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $articles = Article::where('tenant_id', $tenant->id)
            ->published()
            ->with('author:id,name')
            ->latest('published_at')
            ->paginate(12);

        return response()->json(['data' => $articles]);
    }

    /**
     * Get single article.
     */
    public function show(string $tenantSlug, string $articleSlug): JsonResponse
    {
        $tenant = $this->findTenantBySlug($tenantSlug);
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }

        $article = Article::where('tenant_id', $tenant->id)
            ->where('slug', $articleSlug)
            ->published()
            ->with('author:id,name')
            ->first();

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        return response()->json(['data' => $article]);
    }

    /**
     * Find tenant by slug.
     */
    protected function findTenantBySlug(string $slug): ?Tenant
    {
        return Tenant::where('slug', $slug)->active()->first();
    }
}