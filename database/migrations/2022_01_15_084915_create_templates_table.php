<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//templates
//document_type_id | result_type_id | subject_type_id | subject_id | subject_type_id | template
//1		          2		              null	                                        html
//null		          null		              3	                                                html
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('subject_type_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('result_type_id')->nullable();
            $table->longText('template')->nullable();
            $table->timestamps();

            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->foreign('subject_type_id')->references('id')->on('lawsuit_subject_types');
            $table->foreign('subject_id')->references('id')->on('lawsuit_subjects');
            $table->foreign('result_type_id')->references('id')->on('lawsuit_result_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
