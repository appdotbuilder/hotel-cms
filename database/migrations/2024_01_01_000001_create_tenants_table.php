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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Hotel name');
            $table->string('slug')->unique()->comment('URL-safe identifier');
            $table->string('domain')->nullable()->unique()->comment('Custom domain');
            $table->string('database_name')->unique()->comment('Tenant database name');
            $table->json('config')->nullable()->comment('Tenant-specific configuration');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('slug');
            $table->index('domain');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};