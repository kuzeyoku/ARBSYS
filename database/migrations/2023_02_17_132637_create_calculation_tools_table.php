<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation_tools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name", 255);
            $table->string("description", 255);
            $table->boolean("status");
            $table->string("url", 300);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("calculation_tools");
    }
}
