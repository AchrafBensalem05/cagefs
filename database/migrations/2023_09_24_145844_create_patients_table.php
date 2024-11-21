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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string("phone")->nullable();
            $table->string('email');
            $table->string('password');
            $table->enum("sex" , ['male' , 'female'])->default("male");
            $table->enum('blood' , \App\Models\Patient::bloud_group);
            $table->string('auth0_google')->nullable();
            $table->unsignedBigInteger("daira_id")->nullable();
            $table->enum('donor' , ['yes' , 'no'])->default("no");
            $table->string('birth_date');
            $table->longText('chronic_diseases')->nullable();
            $table->string('address')->nullable();
            $table->enum("blocked" , ['yes' , "no"])->default("yes");
            $table->timestamps();

            $table->foreign('daira_id')->references('id')->on('dairas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
