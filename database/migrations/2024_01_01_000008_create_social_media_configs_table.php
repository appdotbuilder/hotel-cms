<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_media_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('platform')->comment('facebook, instagram, twitter, youtube, etc.');
            $table->string('username')->nullable();
            $table->string('url')->nullable();
            $table->string('access_token')->nullable()->comment('For API integrations');
            $table->json('settings')->nullable()->comment('Platform-specific settings');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->unique(['tenant_id', 'platform']);
            $table->index('tenant_id');
            $table->index('platform');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_configs');
    }
};