<?php

use App\Http\Controllers\Api\TenantApiController;
use App\Http\Controllers\Api\TenantArticleController;
use App\Http\Controllers\Api\TenantPackageController;
use App\Http\Controllers\Api\TenantGalleryController;
use App\Http\Controllers\Api\TenantOfferController;
use App\Http\Controllers\Api\TenantEventController;
use App\Http\Controllers\Api\TenantSocialController;
use Illuminate\Support\Facades\Route;

// Public API routes for headless CMS
Route::prefix('api/v1')->group(function () {
    // Tenant information
    Route::get('tenant/{identifier}', [TenantApiController::class, 'show']);
    
    // Content endpoints by tenant slug
    Route::prefix('{tenant_slug}')->group(function () {
        // Articles
        Route::get('articles', [TenantArticleController::class, 'index']);
        Route::get('articles/{article_slug}', [TenantArticleController::class, 'show']);
        
        // Hotel packages
        Route::get('packages', [TenantPackageController::class, 'index']);
        Route::get('packages/{package_slug}', [TenantPackageController::class, 'show']);
        
        // Galleries
        Route::get('galleries', [TenantGalleryController::class, 'index']);
        Route::get('galleries/{gallery_slug}', [TenantGalleryController::class, 'show']);
        
        // Offers
        Route::get('offers', [TenantOfferController::class, 'index']);
        
        // Events
        Route::get('events', [TenantEventController::class, 'index']);
        
        // Social media configurations
        Route::get('social-media', [TenantSocialController::class, 'index']);
    });
});