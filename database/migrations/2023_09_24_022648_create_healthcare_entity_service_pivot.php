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
        Schema::create('healthcare_entity_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('healthcare_entity_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            $table->foreign('healthcare_entity_id')->references('id')->on('healthcare_entities');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcare_entity_service_pivot');
    }
};
