<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fixed_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('baro')->nullable();
            $table->string('registration_no')->nullable();
            $table->integer('user_id');
            $table->string("kep_address")->nullable();
            $table->text("check")->nullable();
            $table->integer("type_id")->default(2);
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
        Schema::dropIfExists('lawyers');
    }
}
