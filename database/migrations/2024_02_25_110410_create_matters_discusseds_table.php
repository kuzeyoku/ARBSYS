<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMattersDiscussedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters_discusseds', function (Blueprint $table) {
            $table->id();
            $table->string("title", 255);
            $table->unsignedBigInteger("lawsuit_subject_type_id");
            $table->unsignedBigInteger("lawsuit_subject_id");
            $table->foreign("lawsuit_subject_type_id")->references("id")->on("lawsuit_subject_types");
            $table->foreign("lawsuit_subject_id")->references("id")->on("lawsuit_subjects");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matters_discusseds');
    }
}
