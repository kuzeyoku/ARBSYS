<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fixed_phone')->nullable();
            $table->string('email')->nullable();
            $table->string("kep_address")->nullable();
            $table->text("check")->nullable();
            $table->integer("tax_office_id")->nullable();
            $table->integer('type_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('peoples');
    }
}
