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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->comment('URL-friendly title');
            $table->text('description');
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('code')->nullable()->comment('Promotional code');
            $table->string('image')->nullable();
            $table->datetime('valid_from');
            $table->datetime('valid_until');
            $table->json('conditions')->nullable()->comment('Terms and conditions');
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->unique(['tenant_id', 'slug']);
            $table->unique(['tenant_id', 'code']);
            $table->index('tenant_id');
            $table->index('status');
            $table->index('valid_from');
            $table->index('valid_until');
            $table->index(['tenant_id', 'status', 'valid_from', 'valid_until']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};