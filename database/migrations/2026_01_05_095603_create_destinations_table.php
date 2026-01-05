<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('location');
            $table->string('state');
            $table->string('category');
            $table->integer('price');
            $table->decimal('rating', 3, 1)->default(4.0);
            $table->string('image')->nullable();
            $table->text('description');
            $table->text('overview')->nullable();
            $table->json('attractions')->nullable();
            $table->json('nearby_areas')->nullable();
            $table->json('travel_tips')->nullable();
            $table->integer('hotels_count')->default(0);
            $table->string('best_time')->nullable();
            $table->string('ideal_duration')->nullable();
            $table->string('type')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};