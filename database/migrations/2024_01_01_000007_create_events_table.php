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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->comment('URL-friendly title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->datetime('start_datetime');
            $table->datetime('end_datetime')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->integer('max_attendees')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('additional_info')->nullable()->comment('Contact info, requirements, etc.');
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->timestamps();
            
            // Indexes
            $table->unique(['tenant_id', 'slug']);
            $table->index('tenant_id');
            $table->index('status');
            $table->index('start_datetime');
            $table->index('end_datetime');
            $table->index(['tenant_id', 'status', 'start_datetime']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};