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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sender_id");
            $table->enum('sender_type', ['healthcare','patient']);
            $table->enum('receiver_type', ['healthcare','patient']);
            $table->unsignedBigInteger('receiver_id');
            $table->longText("content")->nullable();
            $table->enum('seen' ,['yes'  ,'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
