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
        Schema::create('healthcare_entities', function (Blueprint $table) {
            $table->id();
            $table->enum("type" , array_keys(\App\Models\HealthcareEntity::Types))->default(0);
            $table->string('name');
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string("titulation")->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('auth0_google')->nullable();
            $table->enum("sex" , ['male' , 'female' , 'both'])->default("male");
            $table->enum("blocked" , ['yes' , "no"])->default("yes");
            $table->dateTime("expired_at")->nullable();
            $table->longText("address")->nullable();
            $table->longText("description")->nullable();
            $table->longText("maps")->nullable();
            $table->longText('opening_hours')->nullable();
            $table->longText("opening_hours_display")->nullable();
            $table->string("average_patient_time")->nullable();
            $table->longText("tags")->nullable();
            $table->longText('diplomas')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('languages')->nullable();
            $table->longText('equipment')->nullable();
            $table->longText('healthcares')->nullable();
            $table->longText('customers_result')->nullable();
            $table->longText('payments')->nullable();
            $table->longText('phones')->nullable();
            $table->string("slug")->nullable();
            $table->unsignedBigInteger("daira_id")->nullable();
            $table->date("open_registration_for_day");
            $table->time('time_before_open_registration_for_day');
            $table->longText('closure_reason')->nullable();
            $table->unsignedBigInteger("limit_patient")->nullable();
            $table->date('closed_in_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('daira_id')->references('id')->on('dairas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcare_entities');
    }
};
