<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMessengerColorToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'messenger_color')) {
                $table->string('messenger_color')->nullable();
            }
        });
        Schema::table('patients', function (Blueprint $table) {
            if (!Schema::hasColumn('patients', 'messenger_color')) {
                $table->string('messenger_color')->nullable();
            }
        });
        Schema::table('healthcare_entities', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('healthcare_entities', 'messenger_color')) {
                $table->string('messenger_color')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('messenger_color');
        });
    }
}
