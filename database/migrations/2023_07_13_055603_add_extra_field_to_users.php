<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('name');
            $table->string('phone_number')->nullable()->after('email');
            $table->unsignedInteger('country_id')->nullable()->after('phone_number');
            $table->tinyInteger('is_active')->default('0')->after('country_id');
            $table->renameColumn('name', 'first_name');            

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
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('country_id');
            $table->dropColumn('is_active');
        });
    }
}
