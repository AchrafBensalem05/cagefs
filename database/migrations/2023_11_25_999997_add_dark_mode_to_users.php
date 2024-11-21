<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDarkModeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('users', 'dark_mode')) {
                $table->boolean('dark_mode')->default(0);
            }
        });
        Schema::table('patients', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('patients', 'dark_mode')) {
                $table->boolean('dark_mode')->default(0);
            }
        });
        Schema::table('healthcare_entities', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('healthcare_entities', 'dark_mode')) {
                $table->boolean('dark_mode')->default(0);
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
            $table->dropColumn('dark_mode');
        });
    }
}
