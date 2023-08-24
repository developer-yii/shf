<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAddedByColumnFromProductCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_codes', function (Blueprint $table) {
            $table->dropColumn('added_by');
            $table->dropColumn('code_checked_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_codes', function (Blueprint $table) {
            $table->string('added_by')->nullable();
            $table->string('code_checked_on')->nullable();
        });
    }
}
