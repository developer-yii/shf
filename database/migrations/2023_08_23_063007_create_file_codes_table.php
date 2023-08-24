<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_file_id')->nullable();
            $table->unsignedBigInteger('product_code_id')->nullable();
            $table->string('code_checked_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_codes');
    }
}
