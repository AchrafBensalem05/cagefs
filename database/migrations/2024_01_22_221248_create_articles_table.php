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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->enum("section" , \App\Models\Article::Section);
            $table->unsignedBigInteger("author_id")->default(0);
            $table->string("location")->nullable();
            $table->longText('content')->nullable();
            $table->string("wilaya")->nullable();
            $table->string("daira")->nullable();
            $table->enum("blood" , \App\Models\Patient::bloud_group)->nullable();
            $table->enum('medication_type' , ['search' , 'offer'])->nullable();
            $table->enum("language" , ['ar' ,'en' , 'fr'])->default('fr');
            $table->enum("emergency" , ['for storage' , 'urgent' , 'very urgent' , 'very very urgent']);
            $table->dateTime('started_at')->nullable();
            $table->longText("payments")->nullable();
            $table->longText("medication")->nullable();
            $table->longText("collecting_time")->nullable();
            $table->unsignedBigInteger("healthcare_id")->nullable();
            $table->enum('area' , ['local' ,'foreign'])->default('local');
            $table->enum("pin" , ["active" , "request" , "pinned"])->default("active");
            $table->unsignedBigInteger("pinner_id")->nullable();
            $table->enum("status" , ['canceled' , 'active' , 'done']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
