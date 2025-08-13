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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->comment('URL-friendly name');
            $table->text('description')->nullable();
            $table->enum('type', ['gallery', 'slideshow'])->default('gallery');
            $table->json('images')->comment('Array of image objects with metadata');
            $table->json('settings')->nullable()->comment('Display settings and configurations');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Indexes
            $table->unique(['tenant_id', 'slug']);
            $table->index('tenant_id');
            $table->index('type');
            $table->index('status');
            $table->index(['tenant_id', 'type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};