<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('wishable_type'); // hotel, destination, package
            $table->unsignedBigInteger('wishable_id');
            $table->json('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'wishable_type', 'wishable_id']);
            $table->index(['wishable_type', 'wishable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};