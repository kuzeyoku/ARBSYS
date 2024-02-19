<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomLawsuitTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_lawsuit_types', function (Blueprint $table) {
            $table->id();
            $table->string("lawsuit_subject_type_name");
            $table->string("lawsuit_subject_name");
            $table->integer("lawsuit_id");
            $table->integer("user_id");
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
        Schema::dropIfExists('custom_lawsuit_types');
    }
}