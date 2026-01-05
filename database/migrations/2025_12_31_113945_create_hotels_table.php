<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('location');
            $table->decimal('rating', 3, 1)->default(4.0);
            $table->integer('price');
            $table->string('type');
            $table->string('image')->nullable();
            $table->text('description');
            $table->json('amenities')->nullable();
            $table->json('features')->nullable();
            $table->json('room_amenities')->nullable();
            $table->json('nearby_attractions')->nullable();
            $table->string('near_location')->nullable();
            $table->integer('recommended_percentage')->default(90);
            $table->boolean('tax_inclusive')->default(true);
            $table->boolean('free_cancellation')->default(true);
            $table->string('check_in_time')->default('14:00');
            $table->string('check_out_time')->default('12:00');
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};