<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Taxoffices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("taxoffices", function (Blueprint $table) {
            $table->id();
            $table->string("province", 100)->nullable(true);
            $table->string("district", 100)->nullable(true);
            $table->string("informantCode", 10)->nullable(true);
            $table->string("taxOfficeName", 200)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("taxoffices");
    }
}
