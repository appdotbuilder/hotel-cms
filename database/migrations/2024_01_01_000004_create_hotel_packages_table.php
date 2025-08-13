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
        Schema::create('hotel_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('hotel_packages')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->comment('URL-friendly name');
            $table->text('description');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->json('features')->nullable()->comment('Package features and amenities');
            $table->json('images')->nullable()->comment('Package images');
            $table->integer('max_occupancy')->nullable();
            $table->integer('duration_days')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Indexes
            $table->unique(['tenant_id', 'slug']);
            $table->index('tenant_id');
            $table->index('parent_id');
            $table->index('status');
            $table->index(['tenant_id', 'status', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_packages');
    }
};