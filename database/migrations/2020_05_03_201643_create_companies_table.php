<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tax_number')->nullable();
            $table->string('mersis_number')->nullable();
            $table->string('detsis_number')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fixed_phone')->nullable();
            $table->string('email')->nullable();
            $table->string("kep_address")->nullable();
            $table->text("check")->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer("trade_registry_id")->nullable();
            $table->string("trade_registry_number")->nullable();
            $table->integer('tax_office_id')->nullable();
            $table->integer("type_id")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
