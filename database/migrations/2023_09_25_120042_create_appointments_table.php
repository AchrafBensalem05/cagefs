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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('name');
            $table->string('current')->nullable();
            $table->string('service_id');
            $table->enum('type' , \App\Models\Appointment::types);
            $table->string("time_passed")->nullable();
            $table->enum('status' , \App\Models\Appointment::status);
            $table->unsignedBigInteger('healthcare_entity_id');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->dateTime('started_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
