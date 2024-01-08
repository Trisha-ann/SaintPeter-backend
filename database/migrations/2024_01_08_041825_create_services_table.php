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
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id')->autoIncrement();
            $table->string('service_vehicle');
            $table->string('service_image');
            $table->string('coffin_type');
            $table->string('coffin_image');
            $table->string('burial_location');
            $table->string('burial_image');
            $table->integer('plan_id')->references('plan_id')->on('plans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
